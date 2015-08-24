<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Endyear
 *
 * @ORM\Table(name="EndYear", indexes={@ORM\Index(name="EndYearTemplateId", columns={"EndYearTemplateId"}), @ORM\Index(name="FormStatusId", columns={"FormStatusId"}), @ORM\Index(name="SupervisorId", columns={"SupervisorId"}), @ORM\Index(name="DevelopmentNeedsId", columns={"DevelopmentNeedsId"})})
 * @ORM\Entity
 */
class Endyear
{
    /**
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Feedbackcycle", mappedBy="endyear")
     */
    protected $feedbackcycle;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateSubmitted", type="date", nullable=true)
     */
    private $datesubmitted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FeedbackDate", type="date", nullable=true)
     */
    private $feedbackdate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isApprovedSup", type="boolean", nullable=true)
     */
    private $isapprovedsup;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isApprovedHR", type="boolean", nullable=true)
     */
    private $isapprovedhr;

    /**
     * @var string
     *
     * @ORM\Column(name="CommentSup", type="text", length=65535, nullable=true)
     */
    private $commentsup;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackHR", type="text", length=65535, nullable=true)
     */
    private $feedbackhr;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationTask1", type="text", length=65535, nullable=true)
     */
    private $evaluationtask1;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationTask2", type="text", length=65535, nullable=true)
     */
    private $evaluationtask2;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationTask3", type="text", length=65535, nullable=true)
     */
    private $evaluationtask3;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationTask4", type="text", length=65535, nullable=true)
     */
    private $evaluationtask4;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationTask5", type="text", length=65535, nullable=true)
     */
    private $evaluationtask5;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationSkill1", type="text", length=65535, nullable=true)
     */
    private $evaluationskill1;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationSkill2", type="text", length=65535, nullable=true)
     */
    private $evaluationskill2;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationSkill3", type="text", length=65535, nullable=true)
     */
    private $evaluationskill3;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationSkill4", type="text", length=65535, nullable=true)
     */
    private $evaluationskill4;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationSkill5", type="text", length=65535, nullable=true)
     */
    private $evaluationskill5;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationOrganization1", type="text", length=65535, nullable=true)
     */
    private $evaluationorganization1;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationOrganization2", type="text", length=65535, nullable=true)
     */
    private $evaluationorganization2;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationOrganization3", type="text", length=65535, nullable=true)
     */
    private $evaluationorganization3;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationOrganization4", type="text", length=65535, nullable=true)
     */
    private $evaluationorganization4;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationOrganization5", type="text", length=65535, nullable=true)
     */
    private $evaluationorganization5;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganization1", type="text", length=65535, nullable=true)
     */
    private $feedbackorganization1;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganization2", type="text", length=65535, nullable=true)
     */
    private $feedbackorganization2;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganization3", type="text", length=65535, nullable=true)
     */
    private $feedbackorganization3;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganization4", type="text", length=65535, nullable=true)
     */
    private $feedbackorganization4;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\User", inversedBy="endyears")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SupervisorId", referencedColumnName="Id")
     * })
     */
    private $supervisor;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Formstatus
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Formstatus", inversedBy="endyears")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FormStatusId", referencedColumnName="Id")
     * })
     */
    private $formstatus;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Endyeartemplate
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Endyeartemplate", inversedBy="endyears")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EndYearTemplateId", referencedColumnName="Id")
     * })
     */
    private $endyeartemplate;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Developmentneeds
     *
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Developmentneeds", cascade={"persist"}, inversedBy="endyear")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DevelopmentNeedsId", referencedColumnName="Id")
     * })
     */
    private $developmentneeds;
    
    /**
     * @ORM\OneToMany(targetEntity="Endyearhistory", cascade={"persist"}, mappedBy="endyear")
     */
    protected $endyearhistories;
    
    public function __construct1()
    {
        $this->endyearhistories = new ArrayCollection();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->endyearhistories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set datesubmitted
     *
     * @param \DateTime $datesubmitted
     * @return Endyear
     */
    public function setDatesubmitted($datesubmitted)
    {
        $this->datesubmitted = $datesubmitted;

        return $this;
    }

    /**
     * Get datesubmitted
     *
     * @return \DateTime 
     */
    public function getDatesubmitted()
    {
        return $this->datesubmitted;
    }

    /**
     * Set feedbackdate
     *
     * @param \DateTime $feedbackdate
     * @return Endyear
     */
    public function setFeedbackdate($feedbackdate)
    {
        $this->feedbackdate = $feedbackdate;

        return $this;
    }

    /**
     * Get feedbackdate
     *
     * @return \DateTime 
     */
    public function getFeedbackdate()
    {
        return $this->feedbackdate;
    }

    /**
     * Set isapprovedsup
     *
     * @param boolean $isapprovedsup
     * @return Endyear
     */
    public function setIsapprovedsup($isapprovedsup)
    {
        $this->isapprovedsup = $isapprovedsup;

        return $this;
    }

    /**
     * Get isapprovedsup
     *
     * @return boolean 
     */
    public function getIsapprovedsup()
    {
        return $this->isapprovedsup;
    }

    /**
     * Set isapprovedhr
     *
     * @param boolean $isapprovedhr
     * @return Endyear
     */
    public function setIsapprovedhr($isapprovedhr)
    {
        $this->isapprovedhr = $isapprovedhr;

        return $this;
    }

    /**
     * Get isapprovedhr
     *
     * @return boolean 
     */
    public function getIsapprovedhr()
    {
        return $this->isapprovedhr;
    }

    /**
     * Set commentsup
     *
     * @param string $commentsup
     * @return Endyear
     */
    public function setCommentsup($commentsup)
    {
        $this->commentsup = $commentsup;

        return $this;
    }

    /**
     * Get commentsup
     *
     * @return string 
     */
    public function getCommentsup()
    {
        return $this->commentsup;
    }

    /**
     * Set feedbackhr
     *
     * @param string $feedbackhr
     * @return Endyear
     */
    public function setFeedbackhr($feedbackhr)
    {
        $this->feedbackhr = $feedbackhr;

        return $this;
    }

    /**
     * Get feedbackhr
     *
     * @return string 
     */
    public function getFeedbackhr()
    {
        return $this->feedbackhr;
    }

    /**
     * Set evaluationtask1
     *
     * @param string $evaluationtask1
     * @return Endyear
     */
    public function setEvaluationtask1($evaluationtask1)
    {
        $this->evaluationtask1 = $evaluationtask1;

        return $this;
    }

    /**
     * Get evaluationtask1
     *
     * @return string 
     */
    public function getEvaluationtask1()
    {
        return $this->evaluationtask1;
    }

    /**
     * Set evaluationtask2
     *
     * @param string $evaluationtask2
     * @return Endyear
     */
    public function setEvaluationtask2($evaluationtask2)
    {
        $this->evaluationtask2 = $evaluationtask2;

        return $this;
    }

    /**
     * Get evaluationtask2
     *
     * @return string 
     */
    public function getEvaluationtask2()
    {
        return $this->evaluationtask2;
    }

    /**
     * Set evaluationtask3
     *
     * @param string $evaluationtask3
     * @return Endyear
     */
    public function setEvaluationtask3($evaluationtask3)
    {
        $this->evaluationtask3 = $evaluationtask3;

        return $this;
    }

    /**
     * Get evaluationtask3
     *
     * @return string 
     */
    public function getEvaluationtask3()
    {
        return $this->evaluationtask3;
    }

    /**
     * Set evaluationtask4
     *
     * @param string $evaluationtask4
     * @return Endyear
     */
    public function setEvaluationtask4($evaluationtask4)
    {
        $this->evaluationtask4 = $evaluationtask4;

        return $this;
    }

    /**
     * Get evaluationtask4
     *
     * @return string 
     */
    public function getEvaluationtask4()
    {
        return $this->evaluationtask4;
    }

    /**
     * Set evaluationtask5
     *
     * @param string $evaluationtask5
     * @return Endyear
     */
    public function setEvaluationtask5($evaluationtask5)
    {
        $this->evaluationtask5 = $evaluationtask5;

        return $this;
    }

    /**
     * Get evaluationtask5
     *
     * @return string 
     */
    public function getEvaluationtask5()
    {
        return $this->evaluationtask5;
    }

    /**
     * Set evaluationskill1
     *
     * @param string $evaluationskill1
     * @return Endyear
     */
    public function setEvaluationskill1($evaluationskill1)
    {
        $this->evaluationskill1 = $evaluationskill1;

        return $this;
    }

    /**
     * Get evaluationskill1
     *
     * @return string 
     */
    public function getEvaluationskill1()
    {
        return $this->evaluationskill1;
    }

    /**
     * Set evaluationskill2
     *
     * @param string $evaluationskill2
     * @return Endyear
     */
    public function setEvaluationskill2($evaluationskill2)
    {
        $this->evaluationskill2 = $evaluationskill2;

        return $this;
    }

    /**
     * Get evaluationskill2
     *
     * @return string 
     */
    public function getEvaluationskill2()
    {
        return $this->evaluationskill2;
    }

    /**
     * Set evaluationskill3
     *
     * @param string $evaluationskill3
     * @return Endyear
     */
    public function setEvaluationskill3($evaluationskill3)
    {
        $this->evaluationskill3 = $evaluationskill3;

        return $this;
    }

    /**
     * Get evaluationskill3
     *
     * @return string 
     */
    public function getEvaluationskill3()
    {
        return $this->evaluationskill3;
    }

    /**
     * Set evaluationskill4
     *
     * @param string $evaluationskill4
     * @return Endyear
     */
    public function setEvaluationskill4($evaluationskill4)
    {
        $this->evaluationskill4 = $evaluationskill4;

        return $this;
    }

    /**
     * Get evaluationskill4
     *
     * @return string 
     */
    public function getEvaluationskill4()
    {
        return $this->evaluationskill4;
    }

    /**
     * Set evaluationskill5
     *
     * @param string $evaluationskill5
     * @return Endyear
     */
    public function setEvaluationskill5($evaluationskill5)
    {
        $this->evaluationskill5 = $evaluationskill5;

        return $this;
    }

    /**
     * Get evaluationskill5
     *
     * @return string 
     */
    public function getEvaluationskill5()
    {
        return $this->evaluationskill5;
    }

    /**
     * Set evaluationorganization1
     *
     * @param string $evaluationorganization1
     * @return Endyear
     */
    public function setEvaluationorganization1($evaluationorganization1)
    {
        $this->evaluationorganization1 = $evaluationorganization1;

        return $this;
    }

    /**
     * Get evaluationorganization1
     *
     * @return string 
     */
    public function getEvaluationorganization1()
    {
        return $this->evaluationorganization1;
    }

    /**
     * Set evaluationorganization2
     *
     * @param string $evaluationorganization2
     * @return Endyear
     */
    public function setEvaluationorganization2($evaluationorganization2)
    {
        $this->evaluationorganization2 = $evaluationorganization2;

        return $this;
    }

    /**
     * Get evaluationorganization2
     *
     * @return string 
     */
    public function getEvaluationorganization2()
    {
        return $this->evaluationorganization2;
    }

    /**
     * Set evaluationorganization3
     *
     * @param string $evaluationorganization3
     * @return Endyear
     */
    public function setEvaluationorganization3($evaluationorganization3)
    {
        $this->evaluationorganization3 = $evaluationorganization3;

        return $this;
    }

    /**
     * Get evaluationorganization3
     *
     * @return string 
     */
    public function getEvaluationorganization3()
    {
        return $this->evaluationorganization3;
    }

    /**
     * Set evaluationorganization4
     *
     * @param string $evaluationorganization4
     * @return Endyear
     */
    public function setEvaluationorganization4($evaluationorganization4)
    {
        $this->evaluationorganization4 = $evaluationorganization4;

        return $this;
    }

    /**
     * Get evaluationorganization4
     *
     * @return string 
     */
    public function getEvaluationorganization4()
    {
        return $this->evaluationorganization4;
    }

    /**
     * Set evaluationorganization5
     *
     * @param string $evaluationorganization5
     * @return Endyear
     */
    public function setEvaluationorganization5($evaluationorganization5)
    {
        $this->evaluationorganization5 = $evaluationorganization5;

        return $this;
    }

    /**
     * Get evaluationorganization5
     *
     * @return string 
     */
    public function getEvaluationorganization5()
    {
        return $this->evaluationorganization5;
    }

    /**
     * Set feedbackorganization1
     *
     * @param string $feedbackorganization1
     * @return Endyear
     */
    public function setFeedbackorganization1($feedbackorganization1)
    {
        $this->feedbackorganization1 = $feedbackorganization1;

        return $this;
    }

    /**
     * Get feedbackorganization1
     *
     * @return string 
     */
    public function getFeedbackorganization1()
    {
        return $this->feedbackorganization1;
    }

    /**
     * Set feedbackorganization2
     *
     * @param string $feedbackorganization2
     * @return Endyear
     */
    public function setFeedbackorganization2($feedbackorganization2)
    {
        $this->feedbackorganization2 = $feedbackorganization2;

        return $this;
    }

    /**
     * Get feedbackorganization2
     *
     * @return string 
     */
    public function getFeedbackorganization2()
    {
        return $this->feedbackorganization2;
    }

    /**
     * Set feedbackorganization3
     *
     * @param string $feedbackorganization3
     * @return Endyear
     */
    public function setFeedbackorganization3($feedbackorganization3)
    {
        $this->feedbackorganization3 = $feedbackorganization3;

        return $this;
    }

    /**
     * Get feedbackorganization3
     *
     * @return string 
     */
    public function getFeedbackorganization3()
    {
        return $this->feedbackorganization3;
    }

    /**
     * Set feedbackorganization4
     *
     * @param string $feedbackorganization4
     * @return Endyear
     */
    public function setFeedbackorganization4($feedbackorganization4)
    {
        $this->feedbackorganization4 = $feedbackorganization4;

        return $this;
    }

    /**
     * Get feedbackorganization4
     *
     * @return string 
     */
    public function getFeedbackorganization4()
    {
        return $this->feedbackorganization4;
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
     * Set feedbackcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycle
     * @return Endyear
     */
    public function setFeedbackcycle(\IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycle = null)
    {
        $this->feedbackcycle = $feedbackcycle;

        return $this;
    }

    /**
     * Get feedbackcycle
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Feedbackcycle 
     */
    public function getFeedbackcycle()
    {
        return $this->feedbackcycle;
    }

    /**
     * Set supervisor
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $supervisor
     * @return Endyear
     */
    public function setSupervisor(\IntoPeople\DatabaseBundle\Entity\User $supervisor = null)
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    /**
     * Get supervisor
     *
     * @return \IntoPeople\DatabaseBundle\Entity\User 
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Set formstatus
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Formstatus $formstatus
     * @return Endyear
     */
    public function setFormstatus(\IntoPeople\DatabaseBundle\Entity\Formstatus $formstatus = null)
    {
        $this->formstatus = $formstatus;

        return $this;
    }

    /**
     * Get formstatus
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Formstatus 
     */
    public function getFormstatus()
    {
        return $this->formstatus;
    }

    /**
     * Set endyeartemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyeartemplate $endyeartemplate
     * @return Endyear
     */
    public function setEndyeartemplate(\IntoPeople\DatabaseBundle\Entity\Endyeartemplate $endyeartemplate = null)
    {
        $this->endyeartemplate = $endyeartemplate;

        return $this;
    }

    /**
     * Get endyeartemplate
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Endyeartemplate 
     */
    public function getEndyeartemplate()
    {
        return $this->endyeartemplate;
    }

    /**
     * Set developmentneeds
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Developmentneeds $developmentneeds
     * @return Endyear
     */
    public function setDevelopmentneeds(\IntoPeople\DatabaseBundle\Entity\Developmentneeds $developmentneeds = null)
    {
        $this->developmentneeds = $developmentneeds;

        return $this;
    }

    /**
     * Get developmentneeds
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Developmentneeds 
     */
    public function getDevelopmentneeds()
    {
        return $this->developmentneeds;
    }

    /**
     * Add endyearhistories
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyearhistory $endyearhistories
     * @return Endyear
     */
    public function addEndyearhistory(\IntoPeople\DatabaseBundle\Entity\Endyearhistory $endyearhistories)
    {
        $this->endyearhistories[] = $endyearhistories;

        return $this;
    }

    /**
     * Remove endyearhistories
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyearhistory $endyearhistories
     */
    public function removeEndyearhistory(\IntoPeople\DatabaseBundle\Entity\Endyearhistory $endyearhistories)
    {
        $this->endyearhistories->removeElement($endyearhistories);
    }

    /**
     * Get endyearhistories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEndyearhistories()
    {
        return $this->endyearhistories;
    }
}
