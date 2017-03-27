<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use F2000FR\TrainingCenterBundle\Entity\User;
use F2000FR\TrainingCenterBundle\Entity\UserTMQuizzResult;
use F2000FR\QuizzBundle\Entity\ResultQuizz;
use F2000FR\QuizzBundle\Entity\ResultQuestion;
use F2000FR\QuizzBundle\Entity\ResultResponse;
use F2000FR\QuizzBundle\Form\ResultQuizzType;

class ShowController extends BaseController {

    /**
     * @Route("/show/training-planning/{id}", name="show_training_planning")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function trainingPlanningAction($id) {
        // Check user-authentification (at least)
        if (!$this->checkUserRole([User::ROLE_STUDENT, User::ROLE_MANAGER])) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTrainingTmp = $oRepo->findOneById($id);

        return array(
            'title' => 'Planning de la formation',
            'modal_size' => 'modal-lg upsize',
            'subview' => 'F2000FRTrainingCenterBundle:Show:trainingPlanning.html.twig',
            'training' => $oTrainingTmp,
            'btn_label' => 'Fermer',
        );
    }

    /**
     * @Route("/show/training-module/{id}/{tab}", name="show_training_module")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function trainingModuleAction($id, $tab = null) {
        // Check user-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_STUDENT)) {
            return $this->redirectInvalidRole();
        }

        $oRepoTM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:TrainingModule');
        $oTrainingModule = $oRepoTM->find($id);

        $oRepoU = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $oUser = $oRepoU->find($this->get('session')->get('oUser')->getId());

        $oRepoUTMQR = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:UserTMQuizzResult');
        $oUserQuizzResult = $oRepoUTMQR->findOneBy([
            'user' => $oUser,
            'trainingModule' => $oTrainingModule,
        ]);

        $oQuizzResult = null;
        if ($oUserQuizzResult) {
            $oQuizzResult = $oUserQuizzResult->getQuizzResult();
        }

        // Call view Module
        $moduleViewParams = $this->moduleAction(
                $oTrainingModule->getModule()->getId(), $tab
        );

        return array_merge($moduleViewParams, array(
            'subview' => 'F2000FRTrainingCenterBundle:Show:trainingModule.html.twig',
            'trainingModule' => $oTrainingModule,
            'quizzResult' => $oQuizzResult,
        ));
    }

    /**
     * @Route("/show/module/{id}/{tab}", name="show_module")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function moduleAction($id, $tab = null) {
        // Check user-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_STUDENT)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $oModule = $oRepo->findOneById($id);

        $aCorrections = [];
        foreach ($oModule->getExercices() as $oExercice) {
            $path = $oModule->getReference() . '-' . $oExercice->getReference();

            $linuxPath = realpath($this->get('kernel')->getRootDir() . '/../web/env/correction/' . $path);
            $webPath = $this->get('assets.packages')->getUrl('env/correction/' . $path);

            if (file_exists($linuxPath)) {
                $aCorrections[$path] = [];

                // Détection de l'archive
                if (file_exists($linuxPath . '.zip')) {
                    $aCorrections[$path]['zip'] = $webPath . '.zip';
                }

                // Détection de l'index
                $indexFile = null;
                if (file_exists($linuxPath . '/index.html')) {
                    $indexFile = 'index.html';
                } else if (file_exists($linuxPath . '/index.php')) {
                    $indexFile = 'index.php';
                }
                if ($indexFile) {
                    $aCorrections[$path]['url'] = $webPath . '/' . $indexFile;
                }
            }
        }

        return array(
            'user' => $this->get('session')->get('oUser'),
            'title' => $oModule->getReference() . ' - ' . $oModule->getName(),
            'modal_size' => 'modal-lg upsize',
            'subview' => 'F2000FRTrainingCenterBundle:Show:module.html.twig',
            'module' => $oModule,
            'tab' => $tab,
            'corrections' => $aCorrections,
            'btn_label' => 'Fermer',
        );
    }

    /**
     * @Route("/show/quizz/{idTrainingModule}", name="show_quizz")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function quizzAction(Request $request, $idTrainingModule) {
        // Check user-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_STUDENT)) {
            return $this->redirectInvalidRole();
        }

        $oRepoTM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:TrainingModule');
        $oTrainingModule = $oRepoTM->find($idTrainingModule);

        // get module and check quizz
        $oModule = $oTrainingModule->getModule();
        if (!$oModule->getQuizz()) {
            return $this->redirectInvalidRole();
        }

        // get user and check if user has already answer the quizz
        $oRepoU = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $oUser = $oRepoU->find($request->getSession()->get('oUser')->getId());

        $oRepoUTMQR = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:UserTMQuizzResult');
        $oUserQuizzResult = $oRepoUTMQR->findBy([
            'user' => $oUser,
            'trainingModule' => $oTrainingModule,
        ]);
        if ($oUserQuizzResult) {
            return $this->redirectInvalidRole();
        }

        // Prepare the session
        $oSession = $request->getSession();
        $sSessionQuizzKey = 'quizz_timer_' . $oModule->getQuizz()->getId();

        // Prepare the ResultQuizz form due to Quizz entity
        $oResultQuizz = new ResultQuizz;
        $oResultQuizz->setQuizz($oModule->getQuizz());
        foreach ($oModule->getQuizz()->getQuestions() as $oQuestion) {
            $oResultQuestion = new ResultQuestion;
            $oResultQuestion->setResultQuizz($oResultQuizz);
            $oResultQuestion->setQuestion($oQuestion);
            $oResultQuizz->addResultQuestion($oResultQuestion);

            foreach ($oQuestion->getResponses() as $oResponse) {
                $oResultResponse = new ResultResponse;
                $oResultResponse->setResultQuestion($oResultQuestion);
                $oResultResponse->setResponse($oResponse);

                $oResultQuestion->addResultResponse($oResultResponse);
            }
        }

        // Create ResultQuizz form
        $oFormQuizz = $this->createForm(ResultQuizzType::class, $oResultQuizz);

        // Handle ResultQuizz reponse
        $oFormQuizz->handleRequest($request);
        if ($oFormQuizz->isSubmitted() && $oFormQuizz->isValid()) {
            $oResultQuizz->setStartDate($oSession->get($sSessionQuizzKey));
            $oResultQuizz->setEndDate(new \DateTime('now'));

            // Calculate result
            $score = 0;
            foreach ($oResultQuizz->getResultQuestions() as $oRQue) {
                $internalScore = 0;
                foreach ($oRQue->getResultResponses() as $oRRes) {
                    if ($oRRes->getChecked() || $oRRes->getResponse()->getValid()) {
                        if ($oRRes->getChecked() && $oRRes->getResponse()->getValid()) {
                            $internalScore += 1;
                        } else {
                            $internalScore -= 0.5;
                        }
                    }
                }

                if ($internalScore > 1) {
                    $internalScore = 1;
                }
                if ($internalScore > 0) {
                    $score += $internalScore;
                }
            }
            $nbQ = count($oResultQuizz->getResultQuestions());
            $oResultQuizz->setScoreRatio(round($score / $nbQ, 2));

            $oUserTMQuizzResult = new UserTMQuizzResult;
            $oUserTMQuizzResult->setUser($oUser);
            $oUserTMQuizzResult->setTrainingModule($oTrainingModule);
            $oUserTMQuizzResult->setQuizzResult($oResultQuizz);

            $em = $this->getDoctrine()->getManager();
            $em->persist($oResultQuizz);
            $em->persist($oUserTMQuizzResult);
            $em->flush();

            return new Response('OK');
        }

        // Start the timer
        $oSession->set($sSessionQuizzKey, new \DateTime('now'));

        return array(
            'title' => 'Quizz ' . $oModule->getReference() . ' - ' . $oModule->getName(),
            'modal_size' => 'modal-lg upsize',
            'subview' => 'F2000FRQuizzBundle:Default:form_result_quizz.html.twig',
            'startDate' => $oResultQuizz->getStartDate(),
            'idTrainingModule' => $idTrainingModule,
            'form' => $oFormQuizz->createView(),
        );
    }

}
