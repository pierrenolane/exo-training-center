<?php

namespace F2000FR\TrainingCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *  name="f2000fr_trainingcenter_user_tm_quizz_result",
 *  uniqueConstraints={
 *      @ORM\UniqueConstraint(name="unique_idx", columns={"user_id", "training_module_id"})
 *  }
 * )
 * @ORM\Entity
 */
class UserTMQuizzResult {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="TMQuizzResults")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="TrainingModule", inversedBy="userQuizzResults")
     * @ORM\JoinColumn(name="training_module_id", referencedColumnName="id")
     */
    private $trainingModule;

    /**
     * @ORM\OneToOne(targetEntity="F2000FR\QuizzBundle\Entity\ResultQuizz", cascade={"persist"})
     */
    private $quizzResult;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\User $user
     *
     * @return UserTMQuizzResult
     */
    public function setUser(\F2000FR\TrainingCenterBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set trainingModule
     *
     * @param \F2000FR\TrainingCenterBundle\Entity\TrainingModule $trainingModule
     *
     * @return UserTMQuizzResult
     */
    public function setTrainingModule(\F2000FR\TrainingCenterBundle\Entity\TrainingModule $trainingModule = null) {
        $this->trainingModule = $trainingModule;

        return $this;
    }

    /**
     * Get trainingModule
     *
     * @return \F2000FR\TrainingCenterBundle\Entity\TrainingModule
     */
    public function getTrainingModule() {
        return $this->trainingModule;
    }

    /**
     * Set quizzResult
     *
     * @param \F2000FR\QuizzBundle\Entity\ResultQuizz $quizzResult
     *
     * @return UserTMQuizzResult
     */
    public function setQuizzResult(\F2000FR\QuizzBundle\Entity\ResultQuizz $quizzResult = null) {
        $this->quizzResult = $quizzResult;

        return $this;
    }

    /**
     * Get quizzResult
     *
     * @return \F2000FR\QuizzBundle\Entity\ResultQuizz
     */
    public function getQuizzResult() {
        return $this->quizzResult;
    }

}
