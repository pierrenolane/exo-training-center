<?php

namespace F2000FR\QuizzBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    /**
     * @Route("/quizz/show-result/{id}", name="quizz_show_result")
     * @Template
     */
    public function showQuizzResultAction($id) {
        $oRepoRQ = $this->getDoctrine()->getRepository('F2000FRQuizzBundle:ResultQuizz');
        $oResultQuizz = $oRepoRQ->find($id);

        return [
            'resultQuizz' => $oResultQuizz,
        ];
    }

}
