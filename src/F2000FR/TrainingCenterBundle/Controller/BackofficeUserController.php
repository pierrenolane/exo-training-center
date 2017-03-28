<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use F2000FR\TrainingCenterBundle\Entity\User;
use F2000FR\TrainingCenterBundle\Form\UserCreateType;
use F2000FR\TrainingCenterBundle\Form\UserUpdateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class BackofficeUserController extends BaseController {

    /**
     * @Route("/backoffice/user", name="bo_user_manage")
     * @Template
     */
    public function manageAction() {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $aList = $oRepo->findAll();

        return array(
            'users' => $aList
        );
    }

    /**
     * @Route("/backoffice/user/create", name="bo_user_create")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function createAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oUserTmp = new User();
        $oForm = $this->createForm(UserCreateType::class, $oUserTmp);

        $oForm->handleRequest($request);
        if ($oForm->isSubmitted() && $oForm->isValid()) {
            //if ($oForm->isValid() && $oUserTmp->isValid()) {
            $oUserTmp->setStatus(User::STATUS_ACTIVE);
            $oUserTmp->setCreatedDate(new \DateTime());
            $oUserTmp->setUpdatedDate(new \DateTime());

            $sPassword = $this->cryptPwd($oUserTmp->getPassword());
            $oUserTmp->setPassword($sPassword);

            $em = $this->getDoctrine()->getManager();
            $em->persist($oUserTmp);
            $em->flush();

            // Notify user
            $message = \Swift_Message::newInstance()
                    ->setSubject('[F2000.FR] Intranet formation - Votre compte vient d\'être créé !')
                    ->setFrom(array('contact@f2000.fr' => 'F2000.FR'))
                    ->setTo($oUserTmp->getEmail())
                    ->setBody(
                    $this->renderView(
                            'F2000FRTrainingCenterBundle:Email:registration.html.twig', array(
                        'user' => $oUserTmp,
                            )
                    ), 'text/html'
                    )
            ;
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('bo_user_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_user_create'),
            'title' => 'Créer un utilisateur',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeUser:form_user.html.twig',
            'form' => $oForm->createView(),
            'btn_label' => 'Créer',
        );
    }

    /**
     * @Route("/backoffice/user/update/{id}", name="bo_user_update", requirements={"id": "\d+"})
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function updateAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $oUser = $oRepo->findOneById($id);

        $oForm = $this->createForm(UserUpdateType::class, $oUser);

        $oForm->handleRequest($request);
        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $oUser->setUpdatedDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($oUser);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_user_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_user_update', ['id' => $oUser->getId()]),
            'title' => 'Mettre à jour l\'utilisateur',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeUser:form_user.html.twig',
            'form' => $oForm->createView(),
            'btn_label' => 'Modifier',
        );
    }

    /**
     * @Route("/backoffice/user/delete/{id}", name="bo_user_delete", requirements={"id": "\d+"})
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function deleteAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:User');
        $oUserTmp = $oRepo->findOneById($id);

        if ($oUserTmp instanceof User && $request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oUserTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_user_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_user_delete', ['id' => $oUserTmp->getId()]),
            'title' => 'Supprimer l\'utilisateur',
            'subview' => 'Êtes-vous sûr de vouloir effectuer cette action ?',
            'btn_type' => 'btn-danger',
            'btn_label' => 'Supprimer',
        );
    }

    private function cryptPwd($sMotdepasse) {
        $sSalt = $this->getParameter('crypt_key');
        return sha1($sSalt . $sMotdepasse . $sSalt);
    }

}
