<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use F2000FR\TrainingCenterBundle\Entity\CalendarOffDay;
use F2000FR\TrainingCenterBundle\Entity\CalendarTM;
use F2000FR\TrainingCenterBundle\Entity\Training;
use F2000FR\TrainingCenterBundle\Entity\TrainingModule;
use F2000FR\TrainingCenterBundle\Entity\User;
use F2000FR\TrainingCenterBundle\Form\TrainingType;
use F2000FR\TrainingCenterBundle\Form\TrainingUserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BackofficeTrainingController extends BaseController {

    /**
     * @Route("/backoffice/training", name="bo_training_manage")
     * @Template
     */
    public function manageAction() {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $aList = $oRepo->findAll();

        return array(
            'trainings' => $aList
        );
    }

    /**
     * @Route("/backoffice/training/create", name="bo_training_create")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function createAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oTrainingTmp = new Training();
        $oForm = $this->createForm(TrainingType::class, $oTrainingTmp);

        $oForm->handleRequest($request);

        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $oTrainingTmp->setEndDate($oTrainingTmp->getEndDate()->add(new \DateInterval('PT23H59M59S')));
            $oTrainingTmp->setCreatedDate(new \DateTime());
            $oTrainingTmp->setUpdatedDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($oTrainingTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_training_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_training_create'),
            'title' => 'Créer une action de formation',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeTraining:form_training.html.twig',
            'form' => $oForm->createView(),
            'btn_label' => 'Créer',
        );
    }

    /**
     * @Route("/backoffice/training/update/{id}", name="bo_training_update", requirements={"id": "\d+"})
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function updateAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTrainingTmp = $oRepo->findOneById($id);

        $oForm = $this->createForm(TrainingType::class, $oTrainingTmp);

        $oForm->handleRequest($request);
        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $oTrainingTmp->setEndDate($oTrainingTmp->getEndDate()->add(new \DateInterval('PT23H59M59S')));
            $oTrainingTmp->setUpdatedDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($oTrainingTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_training_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_training_update', ['id' => $oTrainingTmp->getId()]),
            'title' => 'Mettre à jour l\'action de formation',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeTraining:form_training.html.twig',
            'form' => $oForm->createView(),
            'btn_label' => 'Modifier',
        );
    }

    /**
     * @Route("/backoffice/training/delete/{id}", name="bo_training_delete", requirements={"id": "\d+"})
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function deleteAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTrainingTmp = $oRepo->findOneById($id);

        if ($oTrainingTmp instanceof Training && $request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oTrainingTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_training_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_training_delete', ['id' => $oTrainingTmp->getId()]),
            'title' => 'Supprimer l\'action de formation',
            'subview' => 'Êtes-vous sûr de vouloir effectuer cette action ?',
            'btn_type' => 'btn-danger',
            'btn_label' => 'Supprimer',
        );
    }

    /**
     * @Route("/backoffice/training/update/{id}/users", name="bo_training_update_users")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function updateUsersAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $aAllUsers = $oRepo->findAll();

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTrainingTmp = $oRepo->findOneById($id);

        $oForm = $this->createForm(TrainingUserType::class, $oTrainingTmp);

        if ($request->isMethod('POST')) {
            $training_user = $request->request->get('training_user');

            $selectedUsersIds = [];
            if (array_key_exists('users', $training_user)) {
                $selectedUsersIds = $training_user['users'];
            }

            // remove old users
            foreach ($oTrainingTmp->getUsers() as $oUser) {
                $oTrainingTmp->removeUser($oUser);
                $oUser->removeTraining($oTrainingTmp);
            }

            // add new
            foreach ($aAllUsers as $oUser) {
                if (in_array($oUser->getId(), $selectedUsersIds)) {
                    $oTrainingTmp->addUser($oUser);
                    $oUser->addTraining($oTrainingTmp);
                }
            }

            $oTrainingTmp->setUpdatedDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($oTrainingTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_training_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_training_update_users', ['id' => $oTrainingTmp->getId()]),
            'title' => 'Modifier les participants',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeTraining:form_training_users.html.twig',
            'users' => $aAllUsers,
            'training' => $oTrainingTmp,
            'form' => $oForm->createView(),
            'btn_label' => 'Modifier',
        );
    }

    /**
     * @Route("/backoffice/training/update/{id}/planning", name="bo_training_update_planning")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function updatePlanningAction($id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Category');
        $oAllCategories = $oRepo->findAll();

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTrainingTmp = $oRepo->findOneById($id);

        return array(
            'title' => 'Modifier le planning',
            'modal_size' => 'modal-lg upsize',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeTraining:form_training_planning.html.twig',
            'categories' => $oAllCategories,
            'training' => $oTrainingTmp,
            'btn_label' => 'Fermer',
        );
    }

    /**
     * @Route("/backoffice/training/create/calendar-training-module", name="bo_training_create_calendar_tm")
     * @Method({"POST"})
     */
    public function createCalendarTrainingModuleAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $em = $this->getDoctrine()->getManager();

        $idTraining = $request->get('idTraining');
        $idModule = $request->get('idModule');
        $dayString = $request->get('day');
        $period = $request->get('period');

        // Validate training
        $oRepoT = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTraining = $oRepoT->find($idTraining);

        // Validate module
        $oRepoM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $oModule = $oRepoM->find($idModule);

        // Validate day
        $day = \DateTime::createFromFormat('Ymd', $dayString);
        $day->setTime(0, 0, 0);

        if ($oTraining && $oModule && $this->checkDayPeriod($day, $period)) {
            $em = $this->getDoctrine()->getManager();

            // Find|Create the TrainingModule
            $oRepoTM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:TrainingModule');
            $oTM = $oRepoTM->findOneBy([
                'training' => $oTraining,
                'module' => $oModule,
            ]);
            if (!$oTM) {
                $oTM = new TrainingModule;
                $oTM->setTraining($oTraining);
                $oTM->setModule($oModule);
                $em->persist($oTM);
            }

            // Create calendar training module
            $oCalendarTM = new CalendarTM;
            $oCalendarTM->setTrainingModule($oTM);
            $oCalendarTM->setDay($day);
            $oCalendarTM->setPeriod($period);
            $em->persist($oCalendarTM);

            // Remove calendar off-day if exists
            $oRepoCOD = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:CalendarOffDay');
            $oCalendarOffDay = $oRepoCOD->findOneBy([
                'training' => $oTraining,
                'day' => $day,
                'period' => $period
            ]);

            if ($oCalendarOffDay) {
                $em->remove($oCalendarOffDay);
            }
            $em->flush();

            return new JsonResponse([
                'status' => 'OK',
                'id' => $oCalendarTM->getId(),
                'restricted' => $oCalendarTM->getTrainingModule()->getRestricted(),
            ]);
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/training/update/calendar-training-module", name="bo_training_update_calendar_tm")
     * @Method({"POST"})
     */
    public function updateCalendarTrainingModuleAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idCalendarTM = $request->get('idCalendarTM');
        $dayString = $request->get('day');
        $period = $request->get('period');

        // Validate calendar training module
        $oRepoCTM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:CalendarTM');
        $oCalendarTM = $oRepoCTM->find($idCalendarTM);

        // Validate day
        $day = \DateTime::createFromFormat('Ymd', $dayString);
        $day->setTime(0, 0, 0);

        if ($oCalendarTM && $this->checkDayPeriod($day, $period)) {
            // Update calendar training module
            $oCalendarTM->setDay($day);
            $oCalendarTM->setPeriod($period);

            // Remove calendar off-day if exists
            $oRepoCOD = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:CalendarOffDay');
            $oCalendarOffDay = $oRepoCOD->findOneBy([
                'training' => $oCalendarTM->getTraining(),
                'day' => $day,
                'period' => $period
            ]);

            $em = $this->getDoctrine()->getManager();
            if ($oCalendarOffDay) {
                $em->remove($oCalendarOffDay);
            }
            $em->persist($oCalendarTM);
            $em->flush();

            return new JsonResponse([
                'status' => 'OK',
                'id' => $oCalendarTM->getId(),
                'restricted' => $oCalendarTM->getTrainingModule()->getRestricted(),
            ]);
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/training/delete/calendar-training-module", name="bo_training_delete_calendar_tm")
     * @Method({"POST"})
     */
    public function deleteCalendarTrainingModuleAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idCalendarTM = $request->get('idCalendarTM');

        // Validate calendar training module
        $oRepoCTM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:CalendarTM');
        $oCalendarTM = $oRepoCTM->find($idCalendarTM);

        if ($oCalendarTM) {
            $em = $this->getDoctrine()->getManager();

            // Check TrainingModule
            $oTM = $oCalendarTM->getTrainingModule();
            $oTM->removeCalendarTM($oCalendarTM);
            if (count($oTM->getCalendarTMs()) == 0) {
                $em->remove($oTM);
            }

            $em->remove($oCalendarTM);
            $em->flush();

            return new JsonResponse([
                'status' => 'OK'
            ]);
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/training/update/training-module/status", name="bo_training_update_tm_status")
     * @Method({"POST"})
     */
    public function updateTrainingModuleStatusAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idTrainingModule = $request->get('idTrainingModule');
        $restricted = $request->get('restricted', NULL);

        // Validate training calendar module
        $oRepoTM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:TrainingModule');
        $oTrainingModule = $oRepoTM->find($idTrainingModule);

        // Update training module
        if ($oTrainingModule && !is_null($restricted)) {
            $oTrainingModule->setRestricted((int) $restricted);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse([
                'status' => 'OK',
            ]);
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/training/create/calendar-offday", name="bo_training_create_calendar_offday")
     * @Method({"POST"})
     */
    public function createCalendarOffDayAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idTraining = $request->get('idTraining');
        $dayString = $request->get('day');
        $period = $request->get('period');

        // Validate training
        $oRepoT = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTraining = $oRepoT->find($idTraining);

        // Validate day
        $day = \DateTime::createFromFormat('Ymd', $dayString);
        $day->setTime(0, 0, 0);

        if ($oTraining && $this->checkDayPeriod($day, $period)) {
            $em = $this->getDoctrine()->getManager();

            // Create training calendar off-day
            $oCalendarOffDay = new CalendarOffDay;
            $oCalendarOffDay->setTraining($oTraining);
            $oCalendarOffDay->setDay($day);
            $oCalendarOffDay->setPeriod($period);
            $em->persist($oCalendarOffDay);

            // Delete CalendarTM on same day-period
            $oRepoCTM = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:CalendarTM');
            $qb = $oRepoCTM->createQueryBuilder('ctm')
                    ->innerJoin('ctm.trainingModule', 'tm')
                    ->where('tm.training = :training')
                    ->andWhere('ctm.day = :day')
                    ->andWhere('ctm.period = :period')
                    ->setParameter('training', $oTraining->getId())
                    ->setParameter('day', $day)
                    ->setParameter('period', $period)
                    ->getQuery();
            foreach ($qb->getResult() as $oCalendarTM) {
                $em->remove($oCalendarTM);

                // Check TrainingModule
                $oTM = $oCalendarTM->getTrainingModule();
                $oTM->removeCalendarTM($oCalendarTM);
                if (count($oTM->getCalendarTMs()) == 0) {
                    $em->remove($oTM);
                }
            }
            $em->flush();

            return new JsonResponse([
                'status' => 'OK',
                'res' => $oTM->getCalendarTMs(),
                'id' => $oCalendarOffDay->getId(),
            ]);
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    /**
     * @Route("/backoffice/training/delete/calendar-offday", name="bo_training_delete_calendar_offday")
     * @Method({"POST"})
     */
    public function deleteCalendarOffdayAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        // Check POST-action
        if (!($request->getMethod() == 'POST')) {
            return $this->redirectInvalidRole();
        }

        $idTraining = $request->get('idTraining');
        $dayString = $request->get('day');
        $period = $request->get('period');

        // Validate training
        $oRepoT = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTraining = $oRepoT->find($idTraining);

        // Validate day
        $day = \DateTime::createFromFormat('Ymd', $dayString);
        $day->setTime(0, 0, 0);

        if ($oTraining && $this->checkDayPeriod($day, $period)) {
            $oRepoCOD = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:CalendarOffDay');
            $oCalendarOffDay = $oRepoCOD->findOneBy([
                'training' => $oTraining,
                'day' => $day,
                'period' => $period
            ]);

            if ($oCalendarOffDay) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($oCalendarOffDay);
                $em->flush();
            }

            return new JsonResponse([
                'status' => 'OK'
            ]);
        }

        return new JsonResponse([
            'status' => 'NOK',
        ]);
    }

    private function checkDayPeriod($day, $period) {
        return $day && in_array($period, [CalendarTM::PERIOD_AM, CalendarTM::PERIOD_PM]);
    }

}
