<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use F2000FR\TrainingCenterBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BackofficeController extends BaseController {

    /**
     * @Route("/backoffice/dashboard", name="bo_dashboard")
     * @Template
     */
    public function dashboardAction() {
        // Check manager-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_MANAGER)) {
            return $this->redirectInvalidRole();
        }

        $aTrainings = $this->getAllowedTrainings();

        $aGraphs = [];
        foreach ($aTrainings as $training) {
            $data = $training->getDaysStats();
            $aGraphs[] = array(
                'id' => 'chartTraining' . $training->getId(),
                'name' => $training->getShortName(),
                'data' => $this->convertToJsArray(array(
                    'A' => $data['passed'],
                    'B' => $data['remaining']
                ))
            );
        }

        return array(
            'trainings' => $aTrainings,
            'graphs' => $aGraphs,
        );
    }

    /**
     * @Route("/backoffice/dashboard/training/{id}", name="bo_dashboard_training")
     * @Template
     */
    public function dashboardTrainingAction($id) {
        // Check manager-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_MANAGER)) {
            return $this->redirectInvalidRole();
        }

        $aTrainings = $this->getAllowedTrainings();

        $oTraining = null;
        foreach ($aTrainings as $oTmpTraining) {
            if ($oTmpTraining->getId() == $id) {
                $oTraining = $oTmpTraining;
                break;
            }
        }

        // Check training
        if (!$oTraining) {
            return $this->redirectInvalidRole();
        }

        $aQuizzInfo = [
            'TM' => [],
            'U' => [],
        ];
        foreach ($oTraining->getTrainingModules() as $oTM) {
            $sKey = $oTM->getId();
            $aQuizzInfo['TM'][$sKey] = [
                'globalRatio' => -1,
            ];

            $iScoreRatio = 0;
            foreach ($oTM->getUserQuizzResults() as $oUserTMQuizzResult) {
                $oUser = $oUserTMQuizzResult->getUser();
                $oQR = $oUserTMQuizzResult->getQuizzResult();

                $aQuizzInfo['TM'][$sKey][$oUser->getId()] = $oQR;
                $iScoreRatio += $oQR->getScoreRatio();
            }

            $nbQR = count($oTM->getUserQuizzResults());
            if ($nbQR > 0) {
                $aQuizzInfo['TM'][$sKey]['globalRatio'] = round($iScoreRatio / $nbQR, 2);
            }
        }

        $aCategory = [];
        foreach ($oTraining->getUsers() as $oUser) {
            $aQuizzInfo['U'][$oUser->getId()] = [
                'globalRatio' => -1,
            ];

            $iScoreRatio = 0;
            foreach ($oUser->getTMQuizzResults() as $oUserTMQuizzResult) {
                $oQR = $oUserTMQuizzResult->getQuizzResult();

                $oM = $oUserTMQuizzResult->getTrainingModule()->getModule();
                $sCategoryName = $oM->getCategory()->getName();

                if (!array_key_exists($sCategoryName, $aQuizzInfo['U'][$oUser->getId()])) {
                    $aQuizzInfo['U'][$oUser->getId()][$oM->getCategory()->getName()] = 0;
                }
                $aQuizzInfo['U'][$oUser->getId()][$oM->getCategory()->getName()] += $oQR->getScoreRatio();


                $iScoreRatio += $oQR->getScoreRatio();
            }

            $nbQR = count($oUser->getTMQuizzResults());
            if ($nbQR > 0) {
                $aQuizzInfo['U'][$oUser->getId()]['globalRatio'] = round($iScoreRatio / $nbQR, 2);
            }
        }

        return array(
            'trainings' => $aTrainings,
            'training' => $oTraining,
            'quizzInfo' => $aQuizzInfo,
        );
    }

    /**
     * @Route("/backoffice/manager", name="bo_manager")
     * @Template
     */
    public function managerAction() {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $aTrainings = $oRepo->findAll();

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $aUsers = $oRepo->findAll();

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $aModules = $oRepo->findAll();

        $statsUser = [
            User::STATUS_ACTIVE => 0,
            User::STATUS_RESIGNING => 0,
            User::STATUS_INACTIVE => 0,
        ];
        foreach ($aUsers as $user) {
            if (array_key_exists($user->getStatus(), $statsUser)) {
                $statsUser[$user->getStatus()] ++;
            }
        }

        $statsTrainings = [];
        foreach ($aTrainings as $training) {
            $client = str_replace(array(' ', '.'), '', $training->getClient());
            if (!array_key_exists($client, $statsTrainings)) {
                $statsTrainings[$client] = 0;
            }
            $statsTrainings[$client] ++;
        }

        $statsModules = [
            'category' => [],
            'completion' => [
                'Finalisé' => 0,
                'Encours' => 0,
                'Brouillon' => 0,
            ],
        ];
        foreach ($aModules as $oModule) {
            $category = str_replace(array(' ', '.', '/'), '', $oModule->getCategory()->getName());
            if (!array_key_exists($category, $statsModules['category'])) {
                $statsModules['category'][$category] = 0;
            }
            $statsModules['category'][$category] ++;

            $moduleCompletion = $this->calcModuleCompletion($oModule);

            if ($moduleCompletion == 100) {
                $statsModules['completion']['Finalisé'] ++;
            } elseif ($moduleCompletion >= 75) {
                $statsModules['completion']['Encours'] ++;
            } else {
                $statsModules['completion']['Brouillon'] ++;
            }
        }

        $aGraphs = [];
        $aGraphs[] = array(
            'id' => 'chartUsers',
            'name' => 'Utilisateurs',
            'data' => $this->convertToJsArray(array(
                'Actif' => $statsUser[User::STATUS_ACTIVE],
                'Démissionnaire' => $statsUser[User::STATUS_RESIGNING],
                'Inactif' => $statsUser[User::STATUS_INACTIVE],
            ))
        );
        $aGraphs[] = array(
            'id' => 'chartFormations',
            'name' => 'Formations',
            'data' => $this->convertToJsArray($statsTrainings)
        );
        /* $aGraphs[] = array(
          'id' => 'chartModulesCat',
          'name' => 'Modules / Catégories',
          'data' => $this->convertToJsArray($statsModules['category'])
          ); */
        $aGraphs[] = array(
            'id' => 'chartModulesRea',
            'name' => 'Modules / % de réalisation',
            'data' => $this->convertToJsArray($statsModules['completion'])
        );

        return array(
            'trainings' => $aTrainings,
            'graphs' => $aGraphs,
        );
    }

    private function getAllowedTrainings() {
        $oSessionUser = $this->get('session')->get('oUser');

        // Get User entity
        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $oUser = $oRepo->find($oSessionUser->getId());

        switch ($oUser->getRole()) {
            case User::ROLE_ADMIN:
                $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
                $aTrainings = $oRepo->findAll();
                break;

            case User::ROLE_MANAGER:
                $aTrainings = $oUser->getTrainings();
                break;
        }

        return $aTrainings;
    }

    private function calcModuleCompletion($oModule) {
        $completion = 5;

        if (!empty($oModule->getDescription())) {
            $completion += 15;
        }
        if (!empty($oModule->getKeypoints())) {
            $completion += 15;
        }
        if (!empty($oModule->getRessources())) {
            $completion += 15;
        }

        $pdfFile = $oModule->getReference() . '.pdf';
        $linuxPath = realpath($this->get('kernel')->getRootDir() . '/../web/env/pdf/' . $pdfFile);

        if (file_exists($linuxPath)) {
            $completion += 30;
        }

        $exercice = $oModule->getExercices();
        if (count($exercice) > 0) {
            $completion += 10;
        }

        if ($oModule->getQuizz()) {
            $completion += 10;
        }

        return $completion;
    }

}
