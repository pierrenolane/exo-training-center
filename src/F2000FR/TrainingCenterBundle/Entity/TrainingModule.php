<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Training
 *
 * @ORM\Table(name="f2000fr_trainingcenter_training_module")
 * @ORM\Entity
 */
class TrainingModule {

    const PERIOD_AM = 1;
    const PERIOD_PM = 2;
    const PERIOD_ALLDAY = 3;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="trainingModules")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    private $training;

    /**
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    private $module;

    /**
     * @ORM\OneToMany(targetEntity="CalendarTM", mappedBy="trainingModule")
     */
    private $calendarTMs;

    /**
     * @ORM\OneToMany(targetEntity="UserTMQuizzResult", mappedBy="trainingModule")
     */
    private $userQuizzResults;

    /**
     * @var string
     *
     * @ORM\Column(name="restricted", type="boolean")
     */
    private $restricted = 1;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->calendarTMs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userQuizzResults = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set restricted
     *
     * @param boolean $restricted
     *
     * @return TrainingModule
     */
    public function setRestricted($restricted)
    {
        $this->restricted = $restricted;

        return $this;
    }

    /**
     * Get restricted
     *
     * @return boolean
     */
    public function getRestricted()
    {
        return $this->restricted;
    }

    /**
     * Set training
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Training $training
     *
     * @return TrainingModule
     */
    public function setTraining(\F2000FR\TrainingCenterBundle\Entity\Training $training = null)
    {
        $this->training = $training;

        return $this;
    }

    /**
     * Get training
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\Training
     */
    public function getTraining()
    {
        return $this->training;
    }

    /**
     * Set module
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Module $module
     *
     * @return TrainingModule
     */
    public function setModule(\F2000FR\TrainingCenterBundle\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Add calendarTM
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\CalendarTM $calendarTM
     *
     * @return TrainingModule
     */
    public function addCalendarTM(\F2000FR\TrainingCenterBundle\Entity\CalendarTM $calendarTM)
    {
        $this->calendarTMs[] = $calendarTM;

        return $this;
    }

    /**
     * Remove calendarTM
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\CalendarTM $calendarTM
     */
    public function removeCalendarTM(\F2000FR\TrainingCenterBundle\Entity\CalendarTM $calendarTM)
    {
        $this->calendarTMs->removeElement($calendarTM);
    }

    /**
     * Get calendarTMs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCalendarTMs()
    {
        return $this->calendarTMs;
    }

    /**
     * Add userQuizzResult
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\UserTMQuizzResult $userQuizzResult
     *
     * @return TrainingModule
     */
    public function addUserQuizzResult(\F2000FR\TrainingCenterBundle\Entity\UserTMQuizzResult $userQuizzResult)
    {
        $this->userQuizzResults[] = $userQuizzResult;

        return $this;
    }

    /**
     * Remove userQuizzResult
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\UserTMQuizzResult $userQuizzResult
     */
    public function removeUserQuizzResult(\F2000FR\TrainingCenterBundle\Entity\UserTMQuizzResult $userQuizzResult)
    {
        $this->userQuizzResults->removeElement($userQuizzResult);
    }

    /**
     * Get userQuizzResults
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserQuizzResults()
    {
        return $this->userQuizzResults;
    }
}
