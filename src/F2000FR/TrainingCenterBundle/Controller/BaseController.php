<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use F2000FR\TrainingCenterBundle\Entity\User;

abstract class BaseController extends Controller {

    /**
     */
    public function checkUserRole($acceptedRoles) {
        $oSession = $this->get('session');

        if (!is_array($acceptedRoles)) {
            $acceptedRoles = [$acceptedRoles];
        }
        $acceptedRoles[] = User::ROLE_ADMIN;

        // Check authentification
        $oUser = $oSession->get('oUser', null);
        if (!$oUser instanceof User || !in_array($oUser->getRole(), $acceptedRoles)) {
            return false;
        }

        return true;
    }

    public function redirectInvalidRole() {
        return $this->redirect($this->generateUrl('home'));
    }

    public function convertToJsArray($aData) {
        $str = '';
        foreach ($aData as $key => $val) {
            $str .= $key . ': ' . $val . ', ';
        }
        return '{' . $str . '}';
    }

}
