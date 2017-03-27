<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Module
 *
 * @ORM\Table(name="f2000fr_trainingcenter_module")
 * @ORM\Entity
 */
class Module {

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
     * @ORM\Column(name="reference", type="string", length=25, unique=true)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="modules")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="keypoints", type="text", nullable=true)
     */
    private $keypoints;

    /**
     * @var float
     *
     * @ORM\Column(name="duration", type="float", precision=2, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="ressources", type="text", nullable=true)
     */
    private $ressources;

    /**
     * @var string
     *
     * @ORM\Column(name="private_content", type="text", nullable=true)
     */
    private $privateContent;

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
     * @ORM\OneToMany(targetEntity="Exercice", mappedBy="module", cascade={"persist", "remove"})
     */
    private $exercices;

    /**
     * @ORM\OneToOne(targetEntity="F2000FR\QuizzBundle\Entity\Quizz", cascade={"persist"})
     */
    private $quizz;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Module
     */
    public function setReference($reference) {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference() {
        return $this->reference;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Module
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
     * Set description
     *
     * @param string $description
     *
     * @return Module
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
     * Set duration
     *
     * @param string $duration
     *
     * @return Module
     */
    public function setDuration($duration) {
        $this->duration = floatval($duration);

        return $this;
    }

    /**
     * Get duration
     *
     * @return \double
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * Set ressources
     *
     * @param string $ressources
     *
     * @return Module
     */
    public function setRessources($ressources) {
        $this->ressources = $ressources;

        return $this;
    }

    /**
     * Get ressources
     *
     * @return string
     */
    public function getRessources() {
        return $this->ressources;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Module
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
     * @return Module
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
     * Set category
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Category $category
     *
     * @return Module
     */
    public function setCategory(\F2000FR\TrainingCenterBundle\Entity\Category $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\Category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set keypoints
     *
     * @param string $keypoints
     *
     * @return Module
     */
    public function setKeypoints($keypoints) {
        $this->keypoints = $keypoints;

        return $this;
    }

    /**
     * Get keypoints
     *
     * @return string
     */
    public function getKeypoints() {
        return $this->keypoints;
    }

    /**
     * Set privateContent
     *
     * @param string $privateContent
     *
     * @return Module
     */
    public function setPrivateContent($privateContent) {
        $this->privateContent = $privateContent;

        return $this;
    }

    /**
     * Get privateContent
     *
     * @return string
     */
    public function getPrivateContent() {
        return $this->privateContent;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->exercices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add exercice
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Exercice $exercice
     *
     * @return Module
     */
    public function addExercice(\F2000FR\TrainingCenterBundle\Entity\Exercice $exercice) {
        $this->exercices[] = $exercice;

        return $this;
    }

    /**
     * Remove exercice
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Exercice $exercice
     */
    public function removeExercice(\F2000FR\TrainingCenterBundle\Entity\Exercice $exercice) {
        $this->exercices->removeElement($exercice);
    }

    /**
     * Get exercices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExercices() {
        return $this->exercices;
    }

    /**
     * Set quizz
     *
     * @param \F2000FR\QuizzBundle\Entity\Quizz $quizz
     *
     * @return Module
     */
    public function setQuizz(\F2000FR\QuizzBundle\Entity\Quizz $quizz = null) {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * Get quizz
     *
     * @return \F2000FR\QuizzBundle\Entity\Quizz
     */
    public function getQuizz() {
        return $this->quizz;
    }

}
