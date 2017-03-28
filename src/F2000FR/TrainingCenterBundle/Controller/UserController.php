<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use F2000FR\TrainingCenterBundle\Entity\User;
use F2000FR\TrainingCenterBundle\Entity\CV;
use F2000FR\TrainingCenterBundle\Form\LoginType;
use F2000FR\TrainingCenterBundle\Form\Type\UserAccountType;
use F2000FR\TrainingCenterBundle\Form\Type\CvType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

class UserController extends BaseController {

    /**
     * @Route("/dashboard/{id}", name="user_dashboard")
     * @Template
     */
    public function dashboardAction($id = null) {
        // Check user-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_STUDENT)) {
            return $this->redirectInvalidRole();
        }

        $oSessionUser = $this->get('session')->get('oUser');

        // Get User entity
        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $oUser = $oRepo->find($oSessionUser->getId());

        $currentTraining = null;
        $trainings = [];
        $userQuizzs = [];

        if ($id) {
            foreach ($oUser->getTrainings() as $oTraining) {
                if ($oTraining->getId() == $id) {
                    $currentTraining = $oTraining;
                } else {
                    $trainings[] = $oTraining;
                }
            }
        }

        if (!$currentTraining) {
            $trainings = [];
            foreach ($oUser->getTrainings() as $oTraining) {
                if ($oTraining->isOpen()) {
                    $currentTraining = $oTraining;
                } else {
                    $trainings[] = $oTraining;
                }
            }
        }

        if ($currentTraining) {
            foreach ($oUser->getTMQuizzResults() as $oTmQuizzResult) {
                $idTrainingModule = $oTmQuizzResult->getTrainingModule()->getId();
                $userQuizzs[$idTrainingModule] = $oTmQuizzResult->getQuizzResult();
            }
        }

        return array(
            'user' => $oUser,
            'training' => $currentTraining,
            'trainings' => $trainings,
            'userQuizzs' => $userQuizzs,
        );
    }

    /**
     * @Route("/account", name="user_account")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function accountAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_STUDENT)) {
            return $this->redirectInvalidRole();
        }

        $oSessionUser = $this->get('session')->get('oUser');

        // Get User entity
        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $oUser = $oRepo->find($oSessionUser->getId());

        $oForm = $this->createForm(UserAccountType::class, $oUser);

        $oForm->handleRequest($request);

        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $oUser->setUpdatedDate(new \DateTime());

            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return array(
            'action' => $this->generateUrl('user_account'),
            'title' => 'Mon compte',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeUser:form_user.html.twig',
            'form' => $oForm->createView(),
            'btn_label' => 'Modifier',
        );
    }

    /**
     * @Route("/cv/{id}", name="user_cv")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function cvAction(Request $request, $id = null) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_STUDENT)) {
            return $this->redirectInvalidRole();
        }

        $oSessionUser = $this->get('session')->get('oUser');

        // Get User entity
        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $oUser = $oRepo->find($oSessionUser->getId());

        $oCv = null;
        if ($id && $id != 'null') {
            $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:CV');
            $oCv = $oRepo->find($id);
        } else {
            $aCvs = $oUser->getCvs();
            if ($aCvs) {
                $oCv = $aCvs[0];
            }
        }

        $oNewCv = new CV;
        $oForm = $this->createForm(CvType::class, $oNewCv);

        $oForm->handleRequest($request);
        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $oNewCv->setCreatedDate(new \DateTime());

            $sFilename = md5(uniqid()) . '.pdf';
            $sUploadDir = realpath($this->get('kernel')->getRootDir() . '/../web/cv/');
            $oNewCv->getFile()->move($sUploadDir, $sFilename);
            $oNewCv->setFile($sFilename);

            $oNewCv->setUser($oUser);
            $oUser->addCv($oNewCv);

            $em = $this->getDoctrine()->getManager();
            $em->persist($oNewCv);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return array(
            'action' => $this->generateUrl('user_cv'),
            'modal_size' => 'modal-lg upsize',
            'title' => 'Mes CVs',
            'subview' => 'F2000FRTrainingCenterBundle:User:form_cv.html.twig',
            'cvs' => $oUser->getCvs(),
            'cvToShow' => $oCv,
            'form' => $oForm->createView(),
            'btn_label' => 'Modifier',
        );
    }

    /**
     * @Route("/login", name="login")
     * @Template
     */
    public function loginAction(Request $request) {
        $oSession = $request->getSession();
        $bMaintenance = $this->getParameter('APP_MAINTENANCE', false);

        // Check user-authentification
        if ($oSession->get('oUser', null) instanceof User) {
            return $this->redirect($this->generateUrl('home'));
        }

        $oUser = new User();
        $oForm = $this->createForm(LoginType::class, $oUser);

        $oForm->handleRequest($request);
        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');

            $oUserTmp = $oRepo->findOneByLogin($oUser->getLogin());
            if (!$oUserTmp) {
                $oUserTmp = $oRepo->findOneByEmail($oUser->getLogin());
            }

            $isAccessAllowed = $oUserTmp && ($oUserTmp->isAdmin() || !$bMaintenance);

            if ($isAccessAllowed) {
                //    if ($oUserTmp->verifAuth($oUser->getPassword())) {
                //ENCLENCHER LA FONCTION DE CRYPTAGE ICI
                $cryptPassword = $this->cryptPwd($oUser->getPassword());
                if ($oUserTmp->verifAuth($cryptPassword)) {



                    $oSession->set('oUser', $oUserTmp);
                    return $this->redirect($this->generateUrl('home'));
                } else {
                    $oForm->addError(new FormError('Compte invalide ou désactivé'));
                }
            }
        }

        if ($bMaintenance) {
            $oForm->addError(new FormError('Application en maintenance'));
        }

        return array(
            'form' => $oForm->createView()
        );
    }

    /**
     * @Route("/logout", name="logout")
     * @Template
     */
    public function logoutAction(Request $request) {
        $request->getSession()->clear();
        return $this->redirect($this->generateUrl('login'));
    }

    private function cryptPwd($sMotdepasse) {
        $sSalt = $this->getParameter('crypt_key');
        return sha1($sSalt . $sMotdepasse . $sSalt);
    }

}
