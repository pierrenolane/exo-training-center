<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use F2000FR\TrainingCenterBundle\Entity\Module;
use F2000FR\TrainingCenterBundle\Entity\Exercice;
use F2000FR\TrainingCenterBundle\Entity\User;
use F2000FR\TrainingCenterBundle\Form\ModuleType;
use F2000FR\TrainingCenterBundle\Form\ExerciceType;
use F2000FR\QuizzBundle\Entity\Quizz;
use F2000FR\QuizzBundle\Form\QuizzType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class BackofficeModuleController extends BaseController {

    /**
     * @Route("/backoffice/module", name="bo_module_manage")
     * @Template
     */
    public function manageAction() {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $aList = $oRepo->findBy([], ['reference' => 'ASC']);

        // Calculate completion rate for each modules
        $completionRates = [];
        foreach ($aList as $oModule) {
            $completionRates[$oModule->getId()] = $this->calcModuleCompletion($oModule);
        }


        return array(
            'modules' => $aList,
            'completionRates' => $completionRates,
        );
    }

    /**
     * @Route("/backoffice/module/build", name="bo_module_build")
     * @Template()
     */
    public function buildAction() {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $excludeParts = ['\var\cache', '\var\logs', '\var\sessions', '\vendor', '\nbproject'];

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Exercice');
        $aList = $oRepo->findAll();

        $sCorrectionPath = realpath($this->get('kernel')->getRootDir() . '/../web/env/correction/');
        foreach ($aList as $oExercice) {
            $sExerciceName = $oExercice->getModule()->getReference() . '-' . $oExercice->getReference();

            $sLinuxPath = realpath($sCorrectionPath . '/' . $sExerciceName);
            if (!file_exists($sLinuxPath)) {
                continue;
            }

            $zip = new \ZipArchive();
            if (!$zip->open($sLinuxPath . '.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
                continue;
            }

            $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($sLinuxPath)
            );
            foreach ($files as $file) {
                if (in_array($file->getFilename(), ['.', '..'])) {
                    continue;
                }

                $exclude = false;
                foreach ($excludeParts as $excludePart) {
                    if (strpos($file->getPathname(), $excludePart) !== false) {
                        $exclude = true;
                    }
                }
                if ($exclude) {
                    continue;
                }

                $filename = substr($file->getPathname(), strlen($sLinuxPath) + 1);
                $zip->addFile($file->getPathname(), $filename);
            }
            $zip->close();
        }

        return new JsonResponse([
            'status' => 'OK',
        ]);
    }

    /**
     * @Route("/backoffice/module/create", name="bo_module_create")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function createAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oModuleTmp = new Module();
        $oForm = $this->createForm(ModuleType::class, $oModuleTmp);

        $oForm->handleRequest($request);

        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $oModuleTmp->setCreatedDate(new \DateTime());
            $oModuleTmp->setUpdatedDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($oModuleTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_module_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_module_create'),
            'title' => 'Créer un module de formation',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeModule:form_module_create.html.twig',
            'form' => $oForm->createView(),
            'btn_label' => 'Créer',
        );
    }

    /**
     * @Route("/backoffice/module/update/{id}", name="bo_module_update", requirements={"id": "\d+"})
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function updateAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $oModule = $oRepo->findOneById($id);

        $oFormModule = $this->createForm(ModuleType::class, $oModule);
        $oFormModule->handleRequest($request);
        if ($oFormModule->isSubmitted() && $oFormModule->isValid()) {
            $oModule->setUpdatedDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($oModule);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_module_manage'));
        }

        $oFormExercices = [];
        $oFormExercices['new'] = $this->createForm(ExerciceType::class)->createView();
        foreach ($oModule->getExercices() as $oExercice) {
            $form = $this->createForm(ExerciceType::class, $oExercice);
            $oFormExercices[$oExercice->getReference()] = $form->createView();
        }

        $oFormQuizz = $this->createForm(QuizzType::class, $oModule->getQuizz())->createView();

        return array(
            'module' => $oModule,
            'action' => $this->generateUrl('bo_module_update', ['id' => $oModule->getId()]),
            'modal_size' => 'modal-lg upsize',
            'title' => 'Mettre à jour le module de formation',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeModule:form_module_update.html.twig',
            'formModule' => $oFormModule->createView(),
            'formExercices' => $oFormExercices,
            'formQuizz' => $oFormQuizz,
            'btn_label' => 'Modifier',
        );
    }

    /**
     * @Route("/backoffice/module/delete/{id}", name="bo_module_delete", requirements={"id": "\d+"})
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function deleteAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $oModuleTmp = $oRepo->findOneById($id);

        if ($oModuleTmp instanceof Module && $request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oModuleTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_module_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_module_delete', ['id' => $oModuleTmp->getId()]),
            'title' => 'Supprimer le module de formation',
            'subview' => 'Êtes-vous sûr de vouloir effectuer cette action ?',
            'btn_type' => 'btn-danger',
            'btn_label' => 'Supprimer',
        );
    }

    /**
     * @Route("/backoffice/module/create/quizz", name="bo_module_create_quizz")
     * @Method({"POST"})
     */
    public function createQuizzAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idModule = $request->get('idModule');

        // Validate module
        $oRepoM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $oModule = $oRepoM->find($idModule);

        if ($oModule) {
            $oQuizz = new Quizz;
            $oFormQuizz = $this->createForm(QuizzType::class, $oQuizz);

            $oFormQuizz->handleRequest($request);
            if ($oFormQuizz->isValid()) {
                $oModule->setQuizz($oQuizz);

                $em = $this->getDoctrine()->getManager();
                $em->persist($oQuizz);
                foreach ($oQuizz->getQuestions() as $oQuestion) {
                    $oQuestion->setQuizz($oQuizz);
                    $em->persist($oQuestion);
                    foreach ($oQuestion->getResponses() as $oResponse) {
                        $oResponse->setQuestion($oQuestion);
                        $em->persist($oResponse);
                    }
                }
                $em->flush();

                return new JsonResponse([
                    'status' => 'OK',
                ]);
            }
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/module/update/quizz", name="bo_module_update_quizz")
     * @Method({"POST"})
     */
    public function updateQuizzAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idQuizz = $request->get('idQuizz');

        // Validate quizz
        $oRepoQ = $this->getDoctrine()->getRepository('F2000FRQuizzBundle:Quizz');
        $oQuizz = $oRepoQ->find($idQuizz);

        if ($oQuizz) {
            $oFormQuizz = $this->createForm(QuizzType::class, $oQuizz);

            $oFormQuizz->handleRequest($request);
            if ($oFormQuizz->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return new JsonResponse([
                    'status' => 'OK',
                ]);
            }
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/module/delete/quizz", name="bo_module_delete_quizz")
     * @Method({"POST"})
     */
    public function deleteQuizzAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idModule = $request->get('idModule');
        $idQuizz = $request->get('idQuizz');

        // Validate module
        $oRepoM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $oModule = $oRepoM->find($idModule);

        // Validate quizz
        $oRepoQ = $this->getDoctrine()->getRepository('F2000FRQuizzBundle:Quizz');
        $oQuizz = $oRepoQ->find($idQuizz);

        if ($oModule && $oQuizz) {
            $oModule->setQuizz(null);

            $em = $this->getDoctrine()->getManager();
            $em->remove($oQuizz);
            $em->flush();

            return new JsonResponse([
                'status' => 'OK',
            ]);
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/module/create/exercice", name="bo_module_create_exercice")
     * @Method({"POST"})
     */
    public function createExerciceAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idModule = $request->get('idModule');

        // Validate module
        $oRepoM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $oModule = $oRepoM->find($idModule);

        if ($oModule) {
            $oExercice = new Exercice;
            $oFormExercice = $this->createForm(ExerciceType::class, $oExercice);

            $oFormExercice->handleRequest($request);
            if ($oFormExercice->isValid()) {
                $oExercice->setModule($oModule);

                $em = $this->getDoctrine()->getManager();
                $em->persist($oExercice);
                $em->flush();

                return new JsonResponse([
                    'status' => 'OK',
                ]);
            }
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/module/update/exercice", name="bo_module_update_exercice")
     * @Method({"POST"})
     */
    public function updateExerciceAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idExercice = $request->get('idExercice');

        // Validate exercice
        $oRepoE = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Exercice');
        $oExercice = $oRepoE->find($idExercice);

        if ($oExercice) {
            $oFormExercice = $this->createForm(ExerciceType::class, $oExercice);

            $oFormExercice->handleRequest($request);
            if ($oFormExercice->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return new JsonResponse([
                    'status' => 'OK',
                ]);
            }
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/module/delete/exercice", name="bo_module_delete_exercice")
     * @Method({"POST"})
     */
    public function deleteExerciceAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idExercice = $request->get('idExercice');

        // Validate exercice
        $oRepoE = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Exercice');
        $oExercice = $oRepoE->find($idExercice);

        if ($oExercice) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oExercice);
            $em->flush();

            return new JsonResponse([
                'status' => 'OK',
            ]);
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
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
