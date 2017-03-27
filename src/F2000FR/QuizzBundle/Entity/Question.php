<?php

namespace F2000FR\QuizzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="f2000fr_trainingcenter_qcm_question")
 * @ORM\Entity
 */
class Question {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Quizz", inversedBy="questions")
     * @ORM\JoinColumn(name="quizz_id", referencedColumnName="id", nullable=false)
     */
    private $quizz;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Response", mappedBy="question", cascade={"persist", "remove"})
     */
    private $responses;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->responses = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Question
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set quizz
     *
     * @param \F2000FR\QuizzBundle\Entity\Quizz $quizz
     *
     * @return Question
     */
    public function setQuizz(\F2000FR\QuizzBundle\Entity\Quizz $quizz)
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * Get quizz
     *
     * @return \F2000FR\QuizzBundle\Entity\Quizz
     */
    public function getQuizz()
    {
        return $this->quizz;
    }

    /**
     * Add response
     *
     * @param \F2000FR\QuizzBundle\Entity\Response $response
     *
     * @return Question
     */
    public function addResponse(\F2000FR\QuizzBundle\Entity\Response $response)
    {
        $this->responses[] = $response;

        return $this;
    }

    /**
     * Remove response
     *
     * @param \F2000FR\QuizzBundle\Entity\Response $response
     */
    public function removeResponse(\F2000FR\QuizzBundle\Entity\Response $response)
    {
        $this->responses->removeElement($response);
    }

    /**
     * Get responses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponses()
    {
        return $this->responses;
    }
}
