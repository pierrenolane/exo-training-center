<?php

namespace F2000FR\QuizzBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateScoreCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('f2000fr:quizz:update-scores')

                // the short description shown while running "php bin/console list"
                ->setDescription('Regenerates quizz scores')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp('This command allows you to regenerate the quizz scores...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $oDoc = $this->getContainer()->get('doctrine');

        $oRepo = $oDoc->getRepository('F2000FRQuizzBundle:ResultQuizz');
        $aResultQuizz = $oRepo->findAll();

        foreach ($aResultQuizz as $oResultQuizz) {
            $score = 0;
            foreach ($oResultQuizz->getResultQuestions() as $oRQue) {
                $internalScore = 0;
                foreach ($oRQue->getResultResponses() as $oRRes) {
                    if ($oRRes->getChecked() || $oRRes->getResponse()->getValid()) {
                        if ($oRRes->getChecked() && $oRRes->getResponse()->getValid()) {
                            $internalScore += 1;
                        } else {
                            $internalScore -= 0.5;
                        }
                    }
                }

                if ($internalScore > 1) {
                    $internalScore = 1;
                }
                if ($internalScore > 0) {
                    $score += $internalScore;
                }
            }
            $nbQ = count($oResultQuizz->getResultQuestions());
            $oResultQuizz->setScoreRatio(round($score / $nbQ, 2));
        }

        $oDoc->getManager()->flush();
    }

}
