<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="f2000fr_trainingcenter_category")
 * @ORM\Entity
 */
class Category {

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
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Module", mappedBy="category")
     */
    private $modules;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->modules = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
     * Add module
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Module $module
     *
     * @return Category
     */
    public function addModule(\F2000FR\TrainingCenterBundle\Entity\Module $module) {
        $this->modules[] = $module;

        return $this;
    }

    /**
     * Remove module
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Module $module
     */
    public function removeModule(\F2000FR\TrainingCenterBundle\Entity\Module $module) {
        $this->modules->removeElement($module);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules() {
        return $this->modules;
    }

    /**
     * Set parent
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\F2000FR\TrainingCenterBundle\Entity\Category $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\Category
     */
    public function getParent() {
        return $this->parent;
    }

}
