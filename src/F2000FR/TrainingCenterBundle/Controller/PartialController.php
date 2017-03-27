<?php

namespace F2000FR\TrainingCenterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use F2000FR\TrainingCenterBundle\Entity\User;

class PartialController extends BaseController {

    /**
     * @Route("/partial/training-overview/{id}", name="partial_training_overview")
     * @Template
     */
    public function trainingOverviewAction($id) {
        return $this->trainingPlanningWeekAction($id);
    }

    /**
     * @Route("/partial/training-planning-week/{id}", name="partial_training_planning_week")
     * @Template("F2000FRTrainingCenterBundle:Partial:_trainingPlanning.html.twig")
     */
    public function trainingPlanningWeekAction($id) {
        // Check student-authentification (at least)
        if (!$this->checkUserRole([User::ROLE_STUDENT, User::ROLE_MANAGER])) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTraining = $oRepo->find($id);
        if (!$oTraining) {
            return $this->redirectInvalidRole();
        }

        // Show wanted week
        $firstDay = new \Datetime();
        if ($firstDay->format('N') != 1) {
            $firstDay = new \Datetime('@' . strtotime('last Monday', $firstDay->getTimestamp()));
            $firstDay->setTimezone(new \DateTimeZone('Europe/Paris'));
        }

        $lastDay = clone $firstDay;
        $lastDay = $lastDay->add(new \DateInterval('P6D'));

        $calendarData = $this->buildCalendarInfo($oTraining, $firstDay, $lastDay);

        return array(
            'user' => $this->get('session')->get('oUser'),
            'training' => $oTraining,
            'calendarDays' => $calendarData['calendarDays'],
            'calendarTM' => $calendarData['calendarTM'],
            'calendarOffDays' => $calendarData['calendarOffDays'],
            'hasPrevDays' => ($lastDay > $oTraining->getStartDate()),
            'hasNextDays' => ($lastDay <= $oTraining->getEndDate()),
        );
    }

    /**
     * @Route("/partial/training-planning/{id}/{page}", name="partial_training_planning")
     * @Template
     */
    public function trainingPlanningAction($id, $page = 1) {
        // Check student-authentification (at least)
        if (!$this->checkUserRole([User::ROLE_STUDENT, User::ROLE_MANAGER])) {
            return $this->redirectInvalidRole();
        }
        date_default_timezone_set('Europe/Paris');

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Training');
        $oTraining = $oRepo->findOneById($id);
        if (!$oTraining) {
            return $this->redirectInvalidRole();
        }

        $nbShowWeeks = 2;
        $nbSkipWeeks = 1 * ($page - 1);

        // Start by the first day of the training
        $month = $oTraining->getStartDate()->format('m');
        $year = $oTraining->getStartDate()->format('Y');

        // Then, paginate
        $month += ($page - 1);
        if ($month > 12) {
            $month -= 12;
            $year++;
        }

        // Start planning by monday
        $firstDay = $oTraining->getStartDate();
        if ($firstDay->format('N') != 1) {
            $firstDay = new \Datetime('@' . strtotime('last Monday', $firstDay->getTimestamp()));
            $firstDay->setTimezone(new \DateTimeZone('Europe/Paris'));
        }
        $firstDay->add(new \DateInterval('P' . $nbSkipWeeks . 'W'));

        // End planning by sunday
        $lastDay = clone $firstDay;
        $lastDay->add(new \DateInterval('P' . $nbShowWeeks . 'W'));
        $lastDay->sub(new \DateInterval('P1D'));

        $calendarData = $this->buildCalendarInfo($oTraining, $firstDay, $lastDay);

        return array(
            'user' => $this->get('session')->get('oUser'),
            'calendarDays' => $calendarData['calendarDays'],
            'calendarTM' => $calendarData['calendarTM'],
            'calendarOffDays' => $calendarData['calendarOffDays'],
            'training' => $oTraining,
            'page' => $page,
            'hasPrevDays' => ($page > 1),
            'hasNextDays' => ($lastDay <= $oTraining->getEndDate()),
        );
    }

    /**
     * @Route("/partial/module-pdf-viewer/{id}", name="partial_module_pdf_viewer")
     * @Template("F2000FRTrainingCenterBundle:Partial:pdfViewer.html.twig")
     */
    public function modulePdfViewerAction($id) {
        // Check student-authentification (at least)
        if (!$this->checkUserRole([User::ROLE_STUDENT])) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:Module');
        $oModule = $oRepo->findOneById($id);

        $pdfFile = $oModule->getReference() . '.pdf';
        $linuxPath = realpath($this->get('kernel')->getRootDir() . '/../web/env/pdf/' . $pdfFile);
        $webPath = $this->get('assets.packages')->getUrl('env/pdf/' . $pdfFile);

        $cryptedPdfPath = '';
        if (file_exists($linuxPath)) {
            $cryptedPdfPath = $this->cryptoJsAesEncrypt(
                    $this->getParameter('ENCRYPTION_KEY'), $webPath
            );
        }

        return array(
            'cryptedPdfPath' => $cryptedPdfPath
        );
    }

    /**
     * @Route("/partial/cv-pdf-viewer/{id}", name="partial_cv_pdf_viewer")
     * @Template("F2000FRTrainingCenterBundle:Partial:pdfViewer.html.twig")
     */
    public function cvPdfViewerAction($id) {
        // Check student-authentification (at least)
        if (!$this->checkUserRole([User::ROLE_STUDENT])) {
            return $this->redirectInvalidRole();
        }

        $oRepo = $this->getDoctrine()->getRepository('F2000FRTrainingCenterBundle:CV');
        $oCV = $oRepo->findOneById($id);

        $pdfFile = $oCV->getFile();
        $linuxPath = realpath($this->get('kernel')->getRootDir() . '/../web/cv/' . $pdfFile);
        $webPath = $this->get('assets.packages')->getUrl('cv/' . $pdfFile);

        $cryptedPdfPath = '';
        if (file_exists($linuxPath)) {
            $cryptedPdfPath = $this->cryptoJsAesEncrypt(
                    $this->getParameter('ENCRYPTION_KEY'), $webPath
            );
        }

        return array(
            'cryptedPdfPath' => $cryptedPdfPath
        );
    }

    /**
     * Build calendar info
     *
     * @param \Datetime $firstDay
     * @param \Datetime $lastDay
     * @return array
     */
    private function buildCalendarInfo($oTraining, $firstDay, $lastDay) {
        $data = [
            'calendarDays' => [],
            'calendarTM' => [],
            'calendarOffDays' => [],
        ];

        $currentDay = clone $firstDay;
        while ($currentDay <= $lastDay) {
            $data['calendarDays'][] = array(
                'date' => clone $currentDay,
                'has_training' => ($currentDay >= $oTraining->getStartDate() && $currentDay <= $oTraining->getEndDate())
            );

            $currentDay->add(new \DateInterval('P1D'));
        }

        foreach ($oTraining->getTrainingModules() as $oTM) {
            foreach ($oTM->getCalendarTMs() as $oCalendarTM) {
                $arrayKey = $oCalendarTM->getDay()->format('Ymd') . '_' . $oCalendarTM->getPeriod();
                $data['calendarTM'][$arrayKey][] = $oCalendarTM;
            }
        }

        foreach ($oTraining->getCalendarOffDays() as $oCalendarOffDay) {
            $arrayKey = $oCalendarOffDay->getDay()->format('Ymd') . '_' . $oCalendarOffDay->getPeriod();
            $data['calendarOffDays'][$arrayKey][] = 1;
        }

        return $data;
    }

    /**
     * Decrypt data from a CryptoJS json encoding string
     *
     * @param mixed $passphrase
     * @param mixed $jsonString
     * @return mixed
     */
    private function cryptoJsAesDecrypt($passphrase, $jsonString) {
        $jsondata = json_decode($jsonString, true);
        $salt = hex2bin($jsondata["s"]);
        $ct = base64_decode($jsondata["ct"]);
        $iv = hex2bin($jsondata["iv"]);
        $concatedPassphrase = $passphrase . $salt;
        $md5 = array();
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++) {
            $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        return json_decode($data, true);
    }

    /**
     * Encrypt value to a cryptojs compatiable json encoding string
     *
     * @param mixed $passphrase
     * @param mixed $value
     * @return string
     */
    private function cryptoJsAesEncrypt($passphrase, $value) {
        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx . $passphrase . $salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv = substr($salted, 32, 16);
        $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
        $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
        return json_encode($data);
    }

}
