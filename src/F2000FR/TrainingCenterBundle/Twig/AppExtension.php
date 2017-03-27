<?php

namespace F2000FR\TrainingCenterBundle\Twig;

class AppExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            new \Twig_Function(
                    'scoreInfo', array($this, 'scoreInfoFunction'), array('is_safe' => array('html'))
            ),
        );
    }

    public function scoreInfoFunction($iScore = -1, $bShowInfo = true) {
        $sClass = $sLabel = $sStr = '';

        if ($iScore > 0) {
            $iScore = round($iScore);
        }

        switch ($iScore) {
            case 0 :
            case 1 :
            case 2 :
                $sClass = 'label-danger';
                $sLabel = 'Débutant';
                break;

            case 3 :
                $sClass = 'label-warning';
                $sLabel = 'Intermédiaire';
                break;

            case 4 :
                $sClass = 'label-success';
                $sLabel = 'Correct';
                break;

            case 5 :
                $sClass = 'label-success';
                $sLabel = 'Avancé';
                break;

            default :
                $sClass = 'label-default';
                $sLabel = '&nbsp;';
                break;
        }

        $sStr .= '<span class="label ' . $sClass . '">';
        $sStr .= ($bShowInfo ? $sLabel : '&nbsp;');
        $sStr .= '</span>';


        return $sStr;
    }

}
