<?php

namespace F2000FR\QuizzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="f2000fr_trainingcenter_qcm_result_question")
 * @ORM\Entity
 */
class ResultQuestion {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ResultQuizz", inversedBy="resultQuestions")
     * @ORM\JoinColumn(name="result_quizz_id", referencedColumnName="id", nullable=false)
     */
    private $resultQuizz;

    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="ResultResponse", mappedBy="resultQuestion", cascade={"persist", "remove"})
     */
    private $resultResponses;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resultResponses = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set resultQuizz
     *
     * @param \F2000FR\QuizzBundle\Entity\ResultQuizz $resultQuizz
     *
     * @return ResultQuestion
     */
    public function setResultQuizz(\F2000FR\QuizzBundle\Entity\ResultQuizz $resultQuizz)
    {
        $this->resultQuizz = $resultQuizz;

        return $this;
    }

    /**
     * Get resultQuizz
     *
     * @return \F2000FR\QuizzBundle\Entity\ResultQuizz
     */
    public function getResultQuizz()
    {
        return $this->resultQuizz;
    }

    /**
     * Set question
     *
     * @param \F2000FR\QuizzBundle\Entity\Question $question
     *
     * @return ResultQuestion
     */
    public function setQuestion(\F2000FR\QuizzBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \F2000FR\QuizzBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add resultResponse
     *
     * @param \F2000FR\QuizzBundle\Entity\ResultResponse $resultResponse
     *
     * @return ResultQuestion
     */
    public function addResultResponse(\F2000FR\QuizzBundle\Entity\ResultResponse $resultResponse)
    {
        $this->resultResponses[] = $resultResponse;

        return $this;
    }

    /**
     * Remove resultResponse
     *
     * @param \F2000FR\QuizzBundle\Entity\ResultResponse $resultResponse
     */
    public function removeResultResponse(\F2000FR\QuizzBundle\Entity\ResultResponse $resultResponse)
    {
        $this->resultResponses->removeElement($resultResponse);
    }

    /**
     * Get resultResponses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultResponses()
    {
        return $this->resultResponses;
    }
}
