<?php

namespace F2000FR\QuizzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="f2000fr_trainingcenter_qcm_result_quizz")
 * @ORM\Entity
 */
class ResultQuizz {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Quizz")
     * @ORM\JoinColumn(name="quizz_id", referencedColumnName="id", nullable=false)
     */
    private $quizz;

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
     * @ORM\OneToMany(targetEntity="ResultQuestion", mappedBy="resultQuizz", cascade={"persist", "remove"})
     */
    private $resultQuestions;

    /**
     * @var float
     *
     * @ORM\Column(name="score_ratio", type="float")
     */
    private $scoreRatio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resultQuestions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return ResultQuizz
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return ResultQuizz
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set scoreRatio
     *
     * @param float $scoreRatio
     *
     * @return ResultQuizz
     */
    public function setScoreRatio($scoreRatio)
    {
        $this->scoreRatio = $scoreRatio;

        return $this;
    }

    /**
     * Get scoreRatio
     *
     * @return float
     */
    public function getScoreRatio()
    {
        return $this->scoreRatio;
    }

    /**
     * Set quizz
     *
     * @param \F2000FR\QuizzBundle\Entity\Quizz $quizz
     *
     * @return ResultQuizz
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
     * Add resultQuestion
     *
     * @param \F2000FR\QuizzBundle\Entity\ResultQuestion $resultQuestion
     *
     * @return ResultQuizz
     */
    public function addResultQuestion(\F2000FR\QuizzBundle\Entity\ResultQuestion $resultQuestion)
    {
        $this->resultQuestions[] = $resultQuestion;

        return $this;
    }

    /**
     * Remove resultQuestion
     *
     * @param \F2000FR\QuizzBundle\Entity\ResultQuestion $resultQuestion
     */
    public function removeResultQuestion(\F2000FR\QuizzBundle\Entity\ResultQuestion $resultQuestion)
    {
        $this->resultQuestions->removeElement($resultQuestion);
    }

    /**
     * Get resultQuestions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultQuestions()
    {
        return $this->resultQuestions;
    }
}
