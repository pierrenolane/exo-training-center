<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use F2000FR\TrainingCenterBundle\Entity\Category;
use F2000FR\TrainingCenterBundle\Entity\User;
use F2000FR\TrainingCenterBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class BackofficeCategoryController extends BaseController {

    /**
     * @Route("/backoffice/category", name="bo_category_manage")
     * @Template
     */
    public function manageAction() {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Category');
        $aList = $oRepo->findAll(array(), array('name' => 'ASC'));

        return array(
            'categories' => $aList
        );
    }

    /**
     * @Route("/backoffice/category/create", name="bo_category_create")
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function createAction(Request $request) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oCategoryTmp = new Category();
        $oForm = $this->createForm(CategoryType::class, $oCategoryTmp);

        $oForm->handleRequest($request);

        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oCategoryTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_category_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_category_create'),
            'title' => 'Créer une catégorie',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeCategory:form_category.html.twig',
            'form' => $oForm->createView(),
            'btn_label' => 'Créer',
        );
    }

    /**
     * @Route("/backoffice/category/update/{id}", name="bo_category_update", requirements={"id": "\d+"})
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function updateAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Category');
        $oCategoryTmp = $oRepo->findOneById($id);

        $oForm = $this->createForm(CategoryType::class, $oCategoryTmp);

        $oForm->handleRequest($request);
        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oCategoryTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_category_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_category_update', ['id' => $oCategoryTmp->getId()]),
            'title' => 'Mettre à jour la catégorie',
            'subview' => 'F2000FRTrainingCenterBundle:BackofficeCategory:form_category.html.twig',
            'form' => $oForm->createView(),
            'btn_label' => 'Modifier',
        );
    }

    /**
     * @Route("/backoffice/category/delete/{id}", name="bo_category_delete", requirements={"id": "\d+"})
     * @Template("F2000FRTrainingCenterBundle::modal_dialog.html.twig")
     */
    public function deleteAction(Request $request, $id) {
        // Check admin-authentification (at least)
        if (!$this->checkUserRole(User::ROLE_ADMIN)) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Category');
        $oCategoryTmp = $oRepo->findOneById($id);

        if ($oCategoryTmp instanceof Category && $request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oCategoryTmp);
            $em->flush();

            return $this->redirect($this->generateUrl('bo_category_manage'));
        }

        return array(
            'action' => $this->generateUrl('bo_category_delete', ['id' => $oCategoryTmp->getId()]),
            'title' => 'Supprimer la catégorie',
            'subview' => 'Êtes-vous sûr de vouloir effectuer cette action ?',
            'btn_type' => 'btn-danger',
            'btn_label' => 'Supprimer',
        );
    }

}
