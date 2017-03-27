<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarTM
 *
 * @ORM\Table(
 *  name="f2000fr_trainingcenter_calendar_tm",
 *  uniqueConstraints={
 *      @ORM\UniqueConstraint(name="unique_idx", columns={"training_module_id", "day", "period"})
 *  }
 * )
 * @ORM\Entity
 */
class CalendarTM extends CalendarItem {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TrainingModule", inversedBy="calendarTMs")
     * @ORM\JoinColumn(name="training_module_id", referencedColumnName="id")
     */
    private $trainingModule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="day", type="datetime")
     */
    private $day;

    /**
     * @var int
     *
     * @ORM\Column(name="period", type="integer", length=2)
     */
    private $period;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set day
     *
     * @param \DateTime $day
     *
     * @return CalendarTrainingModule
     */
    public function setDay($day) {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime
     */
    public function getDay() {
        return $this->day;
    }

    /**
     * Set period
     *
     * @param integer $period
     *
     * @return CalendarTrainingModule
     */
    public function setPeriod($period) {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return integer
     */
    public function getPeriod() {
        return $this->period;
    }

    /**
     * Set trainingModule
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\TrainingModule $trainingModule
     *
     * @return CalendarTrainingModule
     */
    public function setTrainingModule(\F2000FR\TrainingCenterBundle\Entity\TrainingModule $trainingModule = null) {
        $this->trainingModule = $trainingModule;

        return $this;
    }

    /**
     * Get trainingModule
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\TrainingModule
     */
    public function getTrainingModule() {
        return $this->trainingModule;
    }

}
