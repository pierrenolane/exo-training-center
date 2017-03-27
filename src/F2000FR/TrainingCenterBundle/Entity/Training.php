<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Training
 *
 * @ORM\Table(name="f2000fr_trainingcenter_training")
 * @ORM\Entity
 */
class Training {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=100)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="sponsor", type="string", length=100, nullable=true)
     */
    private $sponsor;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="private", type="boolean")
     */
    private $private;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_date", type="datetime")
     */
    private $updatedDate;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="trainings")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="TrainingModule", mappedBy="training")
     */
    private $trainingModules;

    /**
     * @ORM\OneToMany(targetEntity="CalendarOffDay", mappedBy="training")
     */
    private $calendarOffDays;

    public function getShortName() {
        $shortName = $this->name . ' - ';
        $shortName .= $this->startDate->format('d/m') . '-' . $this->endDate->format('d/m');

        return $shortName;
    }

    public function getFullName() {
        $fullName = $this->client;

        if ($this->sponsor) {
            $fullName .= ' / ' . $this->sponsor;
        }
        $fullName .= ' - ' . $this->getShortName();

        return $fullName;
    }

    public function isOpen() {
        return (new \DateTime() > $this->startDate) && !$this->isClose();
    }

    public function isClose() {
        return (new \DateTime() > $this->endDate);
    }

    public function getNbTrainingDays() {
        // @TODO : remove days off
        return $this->startDate->diff($this->endDate)->format('%a') + 1;
    }

    public function getDaysStats() {
        $now = new \DateTime();
        $nbPassed = 0;
        $nbRemaining = $this->getNbTrainingDays();

        if ($now > $this->startDate) {
            if ($now < $this->endDate) {
                $nbPassed = $this->startDate->diff($now)->format('%a');
                $nbRemaining = $this->endDate->diff($now)->format('%a') + 1;
            } else {
                $nbPassed = $nbRemaining;
                $nbRemaining = 0;
            }
        }


        return array(
            'passed' => $nbPassed,
            'remaining' => $nbRemaining
        );
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trainingModules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->calendarOffDays = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Training
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set client
     *
     * @param string $client
     *
     * @return Training
     */
    public function setClient($client) {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string
     */
    public function getClient() {
        return $this->client;
    }

    /**
     * Set sponsor
     *
     * @param string $sponsor
     *
     * @return Training
     */
    public function setSponsor($sponsor) {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get sponsor
     *
     * @return string
     */
    public function getSponsor() {
        return $this->sponsor;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Training
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Training
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set private
     *
     * @param boolean $private
     *
     * @return Training
     */
    public function setPrivate($private) {
        $this->private = $private;

        return $this;
    }

    /**
     * Get private
     *
     * @return boolean
     */
    public function getPrivate() {
        return $this->private;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Training
     */
    public function setStartDate($startDate) {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate() {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Training
     */
    public function setEndDate($endDate) {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Training
     */
    public function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate() {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     *
     * @return Training
     */
    public function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate() {
        return $this->updatedDate;
    }

    /**
     * Add user
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\User $user
     *
     * @return Training
     */
    public function addUser(\F2000FR\TrainingCenterBundle\Entity\User $user) {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\User $user
     */
    public function removeUser(\F2000FR\TrainingCenterBundle\Entity\User $user) {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * Add trainingModule
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\TrainingModule $trainingModule
     *
     * @return Training
     */
    public function addTrainingModule(\F2000FR\TrainingCenterBundle\Entity\TrainingModule $trainingModule) {
        $this->trainingModules[] = $trainingModule;

        return $this;
    }

    /**
     * Remove trainingModule
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\TrainingModule $trainingModule
     */
    public function removeTrainingModule(\F2000FR\TrainingCenterBundle\Entity\TrainingModule $trainingModule) {
        $this->trainingModules->removeElement($trainingModule);
    }

    /**
     * Get trainingModules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrainingModules() {
        return $this->trainingModules;
    }

    /**
     * Add calendarOffDay
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\CalendarOffDay $calendarOffDay
     *
     * @return Training
     */
    public function addCalendarOffDay(\F2000FR\TrainingCenterBundle\Entity\CalendarOffDay $calendarOffDay) {
        $this->calendarOffDays[] = $calendarOffDay;

        return $this;
    }

    /**
     * Remove calendarOffDay
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\CalendarOffDay $calendarOffDay
     */
    public function removeCalendarOffDay(\F2000FR\TrainingCenterBundle\Entity\CalendarOffDay $calendarOffDay) {
        $this->calendarOffDays->removeElement($calendarOffDay);
    }

    /**
     * Get calendarOffDays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCalendarOffDays() {
        return $this->calendarOffDays;
    }

}
