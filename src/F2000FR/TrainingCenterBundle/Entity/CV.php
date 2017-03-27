<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="f2000fr_trainingcenter_cv")
 * @ORM\Entity
 */
class CV {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $createdDate;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255, unique=true)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="cvs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return CV
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return CV
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set user
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\User $user
     *
     * @return CV
     */
    public function setUser(\F2000FR\TrainingCenterBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
