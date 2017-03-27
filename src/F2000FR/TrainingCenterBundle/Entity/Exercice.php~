<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercice
 *
 * @ORM\Table(
 *  name="f2000fr_trainingcenter_exercice",
 *  uniqueConstraints={
 *      @ORM\UniqueConstraint(name="unique_idx", columns={"module_id", "reference"})
 *  }
 * )
 * @ORM\Entity
 */
class Exercice {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Module", inversedBy="exercices")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id", nullable=false)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=25)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="how_to", type="text", nullable=true)
     */
    private $howTo;

    /**
     * @var string
     *
     * @ORM\Column(name="clue", type="text", nullable=true)
     */
    private $clue;

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
     * @return Exercice
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
     * @return Exercice
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
     * @return Exercice
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
     * Set module
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Module $module
     *
     * @return Exercice
     */
    public function setModule(\F2000FR\TrainingCenterBundle\Entity\Module $module = null) {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\Module
     */
    public function getModule() {
        return $this->module;
    }

    /**
     * Set howTo
     *
     * @param string $howTo
     *
     * @return Exercice
     */
    public function setHowTo($howTo) {
        $this->howTo = $howTo;

        return $this;
    }

    /**
     * Get howTo
     *
     * @return string
     */
    public function getHowTo() {
        return $this->howTo;
    }

    /**
     * Set clue
     *
     * @param string $clue
     *
     * @return Exercice
     */
    public function setClue($clue) {
        $this->clue = $clue;

        return $this;
    }

    /**
     * Get clue
     *
     * @return string
     */
    public function getClue() {
        return $this->clue;
    }

}
