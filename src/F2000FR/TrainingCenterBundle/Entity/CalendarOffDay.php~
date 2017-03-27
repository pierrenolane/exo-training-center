<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarOffDay
 *
 * @ORM\Table(
 *  name="f2000fr_trainingcenter_calendar_offday",
 *  uniqueConstraints={
 *      @ORM\UniqueConstraint(name="unique_idx", columns={"training_id", "day", "period"})
 *  }
 * )
 * @ORM\Entity
 */
class CalendarOffDay extends CalendarItem {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="calendarOffDays")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    private $training;

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
     * @return CalendarOffDay
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
     * @return CalendarOffDay
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
     * Set training
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Training $training
     *
     * @return CalendarOffDay
     */
    public function setTraining(\F2000FR\TrainingCenterBundle\Entity\Training $training = null) {
        $this->training = $training;

        return $this;
    }

    /**
     * Get training
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\Training
     */
    public function getTraining() {
        return $this->training;
    }

}
