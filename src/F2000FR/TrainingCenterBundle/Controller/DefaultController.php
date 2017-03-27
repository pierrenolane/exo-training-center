<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use F2000FR\TrainingCenterBundle\Entity\User;

class DefaultController extends Controller {

    /**
     * @Route("/", name="home")
     * @Template
     */
    public function indexAction(Request $request) {
        $oSession = $request->getSession();
        $sRedirect = $this->generateUrl('login');

        // Check user-authentification
        $oUser = $oSession->get('oUser', null);
        if ($oUser instanceof User) {
            switch ($oUser->getRole()) {
                case User::ROLE_STUDENT:
                    $sRedirect = $this->generateUrl('user_dashboard');
                    break;

                case User::ROLE_MANAGER:
                case User::ROLE_ADMIN:
                    $sRedirect = $this->generateUrl('bo_dashboard');
                    break;
            }
        }

        return $this->redirect($sRedirect);
    }

}
