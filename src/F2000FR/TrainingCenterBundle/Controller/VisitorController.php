<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class VisitorController extends BaseController {

    /**
     * @Route("/visitor/training-overview/{id}")
     * @Template
     */
    public function trainingOverviewAction($id) {
        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');

        $oTrainingTmp = $oRepo->findOneById($id);
        if (!$oTrainingTmp || $oTrainingTmp->getPrivate()) {
            return $this->redirectInvalidRole();
        }

        return array(
            'training' => $oTrainingTmp,
        );
    }

}
