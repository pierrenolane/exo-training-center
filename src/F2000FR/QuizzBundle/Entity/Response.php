<?php

namespace F2000FR\QuizzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Response
 *
 * @ORM\Table(name="f2000fr_trainingcenter_qcm_response")
 * @ORM\Entity
 */
class Response {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="responses")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="valid", type="boolean")
     */
    private $valid;

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
     * @return Response
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
     * Set valid
     *
     * @param boolean $valid
     *
     * @return Response
     */
    public function setValid($valid) {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid
     *
     * @return boolean
     */
    public function getValid() {
        return $this->valid;
    }

    /**
     * Set question
     *
     * @param \F2000FR\QuizzBundle\Entity\Question $question
     *
     * @return Response
     */
    public function setQuestion(\F2000FR\QuizzBundle\Entity\Question $question) {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \F2000FR\QuizzBundle\Entity\Question
     */
    public function getQuestion() {
        return $this->question;
    }

}
