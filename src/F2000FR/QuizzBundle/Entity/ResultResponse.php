<?php

namespace F2000FR\QuizzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="f2000fr_trainingcenter_qcm_result_response")
 * @ORM\Entity
 */
class ResultResponse {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ResultQuestion", inversedBy="resultResponses")
     * @ORM\JoinColumn(name="result_question_id", referencedColumnName="id", nullable=false)
     */
    private $resultQuestion;

    /**
     * @ORM\ManyToOne(targetEntity="Response")
     * @ORM\JoinColumn(name="response_id", referencedColumnName="id", nullable=false)
     */
    private $response;

    /**
     * @var bool
     *
     * @ORM\Column(name="checked", type="boolean")
     */
    private $checked;


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
     * Set checked
     *
     * @param boolean $checked
     *
     * @return ResultResponse
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return boolean
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set resultQuestion
     *
     * @param \F2000FR\QuizzBundle\Entity\ResultQuestion $resultQuestion
     *
     * @return ResultResponse
     */
    public function setResultQuestion(\F2000FR\QuizzBundle\Entity\ResultQuestion $resultQuestion)
    {
        $this->resultQuestion = $resultQuestion;

        return $this;
    }

    /**
     * Get resultQuestion
     *
     * @return \F2000FR\QuizzBundle\Entity\ResultQuestion
     */
    public function getResultQuestion()
    {
        return $this->resultQuestion;
    }

    /**
     * Set response
     *
     * @param \F2000FR\QuizzBundle\Entity\Response $response
     *
     * @return ResultResponse
     */
    public function setResponse(\F2000FR\QuizzBundle\Entity\Response $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return \F2000FR\QuizzBundle\Entity\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
