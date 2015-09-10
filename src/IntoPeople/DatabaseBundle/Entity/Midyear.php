<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Midyear
 *
 * @ORM\Table(name="MidYear", indexes={@ORM\Index(name="FormStatusId", columns={"FormStatusId"}), @ORM\Index(name="SupervisorId", columns={"SupervisorId"}), @ORM\Index(name="DevelopmentNeedsId", columns={"DevelopmentNeedsId"})})
 * @ORM\Entity
 */
class Midyear
{
    /**
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Feedbackcycle", mappedBy="midyear")
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
     * @ORM\Column(name="ProgressTask1", type="text", length=65535, nullable=true)
     */
    private $progresstask1;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressTask2", type="text", length=65535, nullable=true)
     */
    private $progresstask2;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressTask3", type="text", length=65535, nullable=true)
     */
    private $progresstask3;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressTask4", type="text", length=65535, nullable=true)
     */
    private $progresstask4;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressTask5", type="text", length=65535, nullable=true)
     */
    private $progresstask5;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressSkill1", type="text", length=65535, nullable=true)
     */
    private $progressskill1;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressSkill2", type="text", length=65535, nullable=true)
     */
    private $progressskill2;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressSkill3", type="text", length=65535, nullable=true)
     */
    private $progressskill3;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressSkill4", type="text", length=65535, nullable=true)
     */
    private $progressskill4;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressSkill5", type="text", length=65535, nullable=true)
     */
    private $progressskill5;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressOrganization1", type="text", length=65535, nullable=true)
     */
    private $progressorganization1;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressOrganization2", type="text", length=65535, nullable=true)
     */
    private $progressorganization2;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressOrganization3", type="text", length=65535, nullable=true)
     */
    private $progressorganization3;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressOrganization4", type="text", length=65535, nullable=true)
     */
    private $progressorganization4;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressOrganization5", type="text", length=65535, nullable=true)
     */
    private $progressorganization5;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackSupervisor", type="text", length=65535, nullable=true)
     */
    private $feedbacksupervisor;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganization", type="text", length=65535, nullable=true)
     */
    private $feedbackorganization;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Templateversion
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Templateversion", inversedBy="midyears")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TemplateversionId", referencedColumnName="Id")
     * })
     */
    private $templateversion;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\User", inversedBy="midyears")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SupervisorId", referencedColumnName="Id")
     * })
     */
    private $supervisor;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Formstatus
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Formstatus",cascade={"persist"}, inversedBy="midyears")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FormStatusId", referencedColumnName="Id")
     * })
     */
    private $formstatus;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Developmentneeds
     *
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Developmentneeds", cascade={"persist"}, inversedBy="midyear")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DevelopmentNeedsId", referencedColumnName="Id")
     * })
     */
    private $developmentneeds;
    
    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Midyearhistory", cascade={"persist"}, mappedBy="midyear")
     */
    protected $midyearhistories;
    
    public function __construct1()
    {
        $this->midyearhistories = new ArrayCollection();
    }



    /**
     * Set datesubmitted
     *
     * @param \DateTime $datesubmitted
     *
     * @return Midyear
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
     *
     * @return Midyear
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
     *
     * @return Midyear
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
     *
     * @return Midyear
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
     *
     * @return Midyear
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
     *
     * @return Midyear
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
     * Set progresstask1
     *
     * @param string $progresstask1
     *
     * @return Midyear
     */
    public function setProgresstask1($progresstask1)
    {
        $this->progresstask1 = $progresstask1;

        return $this;
    }

    /**
     * Get progresstask1
     *
     * @return string
     */
    public function getProgresstask1()
    {
        return $this->progresstask1;
    }

    /**
     * Set progresstask2
     *
     * @param string $progresstask2
     *
     * @return Midyear
     */
    public function setProgresstask2($progresstask2)
    {
        $this->progresstask2 = $progresstask2;

        return $this;
    }

    /**
     * Get progresstask2
     *
     * @return string
     */
    public function getProgresstask2()
    {
        return $this->progresstask2;
    }

    /**
     * Set progresstask3
     *
     * @param string $progresstask3
     *
     * @return Midyear
     */
    public function setProgresstask3($progresstask3)
    {
        $this->progresstask3 = $progresstask3;

        return $this;
    }

    /**
     * Get progresstask3
     *
     * @return string
     */
    public function getProgresstask3()
    {
        return $this->progresstask3;
    }

    /**
     * Set progresstask4
     *
     * @param string $progresstask4
     *
     * @return Midyear
     */
    public function setProgresstask4($progresstask4)
    {
        $this->progresstask4 = $progresstask4;

        return $this;
    }

    /**
     * Get progresstask4
     *
     * @return string
     */
    public function getProgresstask4()
    {
        return $this->progresstask4;
    }

    /**
     * Set progresstask5
     *
     * @param string $progresstask5
     *
     * @return Midyear
     */
    public function setProgresstask5($progresstask5)
    {
        $this->progresstask5 = $progresstask5;

        return $this;
    }

    /**
     * Get progresstask5
     *
     * @return string
     */
    public function getProgresstask5()
    {
        return $this->progresstask5;
    }

    /**
     * Set progressskill1
     *
     * @param string $progressskill1
     *
     * @return Midyear
     */
    public function setProgressskill1($progressskill1)
    {
        $this->progressskill1 = $progressskill1;

        return $this;
    }

    /**
     * Get progressskill1
     *
     * @return string
     */
    public function getProgressskill1()
    {
        return $this->progressskill1;
    }

    /**
     * Set progressskill2
     *
     * @param string $progressskill2
     *
     * @return Midyear
     */
    public function setProgressskill2($progressskill2)
    {
        $this->progressskill2 = $progressskill2;

        return $this;
    }

    /**
     * Get progressskill2
     *
     * @return string
     */
    public function getProgressskill2()
    {
        return $this->progressskill2;
    }

    /**
     * Set progressskill3
     *
     * @param string $progressskill3
     *
     * @return Midyear
     */
    public function setProgressskill3($progressskill3)
    {
        $this->progressskill3 = $progressskill3;

        return $this;
    }

    /**
     * Get progressskill3
     *
     * @return string
     */
    public function getProgressskill3()
    {
        return $this->progressskill3;
    }

    /**
     * Set progressskill4
     *
     * @param string $progressskill4
     *
     * @return Midyear
     */
    public function setProgressskill4($progressskill4)
    {
        $this->progressskill4 = $progressskill4;

        return $this;
    }

    /**
     * Get progressskill4
     *
     * @return string
     */
    public function getProgressskill4()
    {
        return $this->progressskill4;
    }

    /**
     * Set progressskill5
     *
     * @param string $progressskill5
     *
     * @return Midyear
     */
    public function setProgressskill5($progressskill5)
    {
        $this->progressskill5 = $progressskill5;

        return $this;
    }

    /**
     * Get progressskill5
     *
     * @return string
     */
    public function getProgressskill5()
    {
        return $this->progressskill5;
    }

    /**
     * Set progressorganization1
     *
     * @param string $progressorganization1
     *
     * @return Midyear
     */
    public function setProgressorganization1($progressorganization1)
    {
        $this->progressorganization1 = $progressorganization1;

        return $this;
    }

    /**
     * Get progressorganization1
     *
     * @return string
     */
    public function getProgressorganization1()
    {
        return $this->progressorganization1;
    }

    /**
     * Set progressorganization2
     *
     * @param string $progressorganization2
     *
     * @return Midyear
     */
    public function setProgressorganization2($progressorganization2)
    {
        $this->progressorganization2 = $progressorganization2;

        return $this;
    }

    /**
     * Get progressorganization2
     *
     * @return string
     */
    public function getProgressorganization2()
    {
        return $this->progressorganization2;
    }

    /**
     * Set progressorganization3
     *
     * @param string $progressorganization3
     *
     * @return Midyear
     */
    public function setProgressorganization3($progressorganization3)
    {
        $this->progressorganization3 = $progressorganization3;

        return $this;
    }

    /**
     * Get progressorganization3
     *
     * @return string
     */
    public function getProgressorganization3()
    {
        return $this->progressorganization3;
    }

    /**
     * Set progressorganization4
     *
     * @param string $progressorganization4
     *
     * @return Midyear
     */
    public function setProgressorganization4($progressorganization4)
    {
        $this->progressorganization4 = $progressorganization4;

        return $this;
    }

    /**
     * Get progressorganization4
     *
     * @return string
     */
    public function getProgressorganization4()
    {
        return $this->progressorganization4;
    }

    /**
     * Set progressorganization5
     *
     * @param string $progressorganization5
     *
     * @return Midyear
     */
    public function setProgressorganization5($progressorganization5)
    {
        $this->progressorganization5 = $progressorganization5;

        return $this;
    }

    /**
     * Get progressorganization5
     *
     * @return string
     */
    public function getProgressorganization5()
    {
        return $this->progressorganization5;
    }

    /**
     * Set feedbacksupervisor
     *
     * @param string $feedbacksupervisor
     *
     * @return Midyear
     */
    public function setFeedbacksupervisor($feedbacksupervisor)
    {
        $this->feedbacksupervisor = $feedbacksupervisor;

        return $this;
    }

    /**
     * Get feedbacksupervisor
     *
     * @return string
     */
    public function getFeedbacksupervisor()
    {
        return $this->feedbacksupervisor;
    }

    /**
     * Set feedbackorganization
     *
     * @param string $feedbackorganization
     *
     * @return Midyear
     */
    public function setFeedbackorganization($feedbackorganization)
    {
        $this->feedbackorganization = $feedbackorganization;

        return $this;
    }

    /**
     * Get feedbackorganization
     *
     * @return string
     */
    public function getFeedbackorganization()
    {
        return $this->feedbackorganization;
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
     * Get developmentneeds
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Developmentneeds
     */
    public function getDevelopmentneeds()
    {
        return $this->developmentneeds;
    }

    /**
     * Set feedbackcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycle
     *
     * @return Midyear
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
     * Set midyeartemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyeartemplate $midyeartemplate
     *
     * @return Midyear
     */
    public function setMidyeartemplate(\IntoPeople\DatabaseBundle\Entity\Midyeartemplate $midyeartemplate = null)
    {
        $this->midyeartemplate = $midyeartemplate;

        return $this;
    }

    /**
     * Get midyeartemplate
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Midyeartemplate
     */
    public function getMidyeartemplate()
    {
        return $this->midyeartemplate;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->midyearhistories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add midyearhistory
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyearhistory $midyearhistory
     *
     * @return Midyear
     */
    public function addMidyearhistory(\IntoPeople\DatabaseBundle\Entity\Midyearhistory $midyearhistory)
    {
        $this->midyearhistories[] = $midyearhistory;

        return $this;
    }

    /**
     * Remove midyearhistory
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyearhistory $midyearhistory
     */
    public function removeMidyearhistory(\IntoPeople\DatabaseBundle\Entity\Midyearhistory $midyearhistory)
    {
        $this->midyearhistories->removeElement($midyearhistory);
    }

    /**
     * Get midyearhistories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMidyearhistories()
    {
        return $this->midyearhistories;
    }

    /**
     * Set supervisor
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $supervisor
     * @return Midyear
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
     * @return Midyear
     */
    public function setFormstatus(\IntoPeople\DatabaseBundle\Entity\Formstatus $formstatus = null)
    {
        $this->formstatus = $formstatus;

        $history = new Midyearhistory();
        $history->setMidyear($this);
        $history->setFormstatus($formstatus);

        $dt = new \DateTime();

        $history->setDate($dt);

        $this->addMidyearhistory($history);

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
     * Set developmentneeds
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Developmentneeds $developmentneeds
     * @return Midyear
     */
    public function setDevelopmentneeds(\IntoPeople\DatabaseBundle\Entity\Developmentneeds $developmentneeds = null)
    {
        $this->developmentneeds = $developmentneeds;

        return $this;
    }

    /**
     * Set templateversion
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Templateversion $templateversion
     * @return Midyear
     */
    public function setTemplateversion(\IntoPeople\DatabaseBundle\Entity\Templateversion $templateversion = null)
    {
        $this->templateversion = $templateversion;

        return $this;
    }

    /**
     * Get templateversion
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Templateversion 
     */
    public function getTemplateversion()
    {
        return $this->templateversion;
    }
}
