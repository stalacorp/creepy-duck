<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Midyeartemplate
 *
 * @ORM\Table(name="MidYearTemplate", indexes={@ORM\Index(name="LanguageId", columns={"LanguageId"}), @ORM\Index(name="OrganizationId", columns={"OrganizationId"})})
 * @ORM\Entity(repositoryClass="IntoPeople\DatabaseBundle\Entity\MidyeartemplateRepository")
 */
class Midyeartemplate
{
    /**
     * @ORM\OneToMany(targetEntity="Midyear", mappedBy="midyeartemplate")
     */
    protected $midyears;
    
    public function __construct()
    {
        $this->midyears = new ArrayCollection();
    }
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="isStandardTemplate", type="boolean", nullable=true)
     */
    private $isstandardtemplate;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="BigTitle", type="text", length=65535, nullable=true)
     */
    private $BigTitle;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Title1", type="text", length=65535, nullable=true)
     */
    private $title1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Title2", type="text", length=65535, nullable=true)
     */
    private $title2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Title3", type="text", length=65535, nullable=true)
     */
    private $title3;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Title4", type="text", length=65535, nullable=true)
     */
    private $title4;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SmallTitle1", type="text", length=65535, nullable=true)
     */
    private $smallTitle1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SmallTitle2", type="text", length=65535, nullable=true)
     */
    private $smallTitle2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SmallTitle3", type="text", length=65535, nullable=true)
     */
    private $smallTitle3;

    /**
     * @var string
     *
     * @ORM\Column(name="WhatWhy", type="text", length=65535, nullable=true)
     */
    private $whatwhy;

    /**
     * @var string
     *
     * @ORM\Column(name="WhatWhyDescription", type="text", length=65535, nullable=true)
     */
    private $whatwhydescription;

    /**
     * @var string
     *
     * @ORM\Column(name="Progress", type="text", length=65535, nullable=true)
     */
    private $progress;

    /**
     * @var string
     *
     * @ORM\Column(name="ProgressDescription", type="text", length=65535, nullable=true)
     */
    private $progressdescription;

    /**
     * @var string
     *
     * @ORM\Column(name="Tasks", type="text", length=65535, nullable=true)
     */
    private $tasks;

    /**
     * @var string
     *
     * @ORM\Column(name="Skills", type="text", length=65535, nullable=true)
     */
    private $skills;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationField", type="text", length=65535, nullable=true)
     */
    private $organizationfield;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackSup", type="text", length=65535, nullable=true)
     */
    private $feedbacksup;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackSupDescription", type="text", length=65535, nullable=true)
     */
    private $feedbacksupdescription;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganization", type="text", length=65535, nullable=true)
     */
    private $feedbackorganization;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganizationDescription", type="text", length=65535, nullable=true)
     */
    private $feedbackorganizationdescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Language", inversedBy="cdptemplates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LanguageId", referencedColumnName="Id")
     * })
     */
    private $language;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Organization
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Organization", inversedBy="cdptemplates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="OrganizationId", referencedColumnName="Id")
     * })
     */
    private $organization;



    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Midyeartemplate
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set whatwhy
     *
     * @param string $whatwhy
     *
     * @return Midyeartemplate
     */
    public function setWhatwhy($whatwhy)
    {
        $this->whatwhy = $whatwhy;

        return $this;
    }

    /**
     * Get whatwhy
     *
     * @return string
     */
    public function getWhatwhy()
    {
        return $this->whatwhy;
    }

    /**
     * Set whatwhydescription
     *
     * @param string $whatwhydescription
     *
     * @return Midyeartemplate
     */
    public function setWhatwhydescription($whatwhydescription)
    {
        $this->whatwhydescription = $whatwhydescription;

        return $this;
    }

    /**
     * Get whatwhydescription
     *
     * @return string
     */
    public function getWhatwhydescription()
    {
        return $this->whatwhydescription;
    }

    /**
     * Set progress
     *
     * @param string $progress
     *
     * @return Midyeartemplate
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return string
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set progressdescription
     *
     * @param string $progressdescription
     *
     * @return Midyeartemplate
     */
    public function setProgressdescription($progressdescription)
    {
        $this->progressdescription = $progressdescription;

        return $this;
    }

    /**
     * Get progressdescription
     *
     * @return string
     */
    public function getProgressdescription()
    {
        return $this->progressdescription;
    }

    /**
     * Set tasks
     *
     * @param string $tasks
     *
     * @return Midyeartemplate
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;

        return $this;
    }

    /**
     * Get tasks
     *
     * @return string
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Set skills
     *
     * @param string $skills
     *
     * @return Midyeartemplate
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills
     *
     * @return string
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set organization
     *
     * @param string $organization
     *
     * @return Midyeartemplate
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set feedbacksup
     *
     * @param string $feedbacksup
     *
     * @return Midyeartemplate
     */
    public function setFeedbacksup($feedbacksup)
    {
        $this->feedbacksup = $feedbacksup;

        return $this;
    }

    /**
     * Get feedbacksup
     *
     * @return string
     */
    public function getFeedbacksup()
    {
        return $this->feedbacksup;
    }

    /**
     * Set feedbacksupdescription
     *
     * @param string $feedbacksupdescription
     *
     * @return Midyeartemplate
     */
    public function setFeedbacksupdescription($feedbacksupdescription)
    {
        $this->feedbacksupdescription = $feedbacksupdescription;

        return $this;
    }

    /**
     * Get feedbacksupdescription
     *
     * @return string
     */
    public function getFeedbacksupdescription()
    {
        return $this->feedbacksupdescription;
    }

    /**
     * Set feedbackorganization
     *
     * @param string $feedbackorganization
     *
     * @return Midyeartemplate
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
     * Set feedbackorganizationdescription
     *
     * @param string $feedbackorganizationdescription
     *
     * @return Midyeartemplate
     */
    public function setFeedbackorganizationdescription($feedbackorganizationdescription)
    {
        $this->feedbackorganizationdescription = $feedbackorganizationdescription;

        return $this;
    }

    /**
     * Get feedbackorganizationdescription
     *
     * @return string
     */
    public function getFeedbackorganizationdescription()
    {
        return $this->feedbackorganizationdescription;
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
     * Add midyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyear
     *
     * @return Midyeartemplate
     */
    public function addMidyear(\IntoPeople\DatabaseBundle\Entity\Midyear $midyear)
    {
        $this->midyears[] = $midyear;

        return $this;
    }

    /**
     * Remove midyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyear
     */
    public function removeMidyear(\IntoPeople\DatabaseBundle\Entity\Midyear $midyear)
    {
        $this->midyears->removeElement($midyear);
    }

    /**
     * Get midyears
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMidyears()
    {
        return $this->midyears;
    }

    /**
     * Set bigTitle
     *
     * @param string $bigTitle
     *
     * @return Midyeartemplate
     */
    public function setBigTitle($bigTitle)
    {
        $this->BigTitle = $bigTitle;

        return $this;
    }

    /**
     * Get bigTitle
     *
     * @return string
     */
    public function getBigTitle()
    {
        return $this->BigTitle;
    }

    /**
     * Set title1
     *
     * @param string $title1
     *
     * @return Midyeartemplate
     */
    public function setTitle1($title1)
    {
        $this->title1 = $title1;

        return $this;
    }

    /**
     * Get title1
     *
     * @return string
     */
    public function getTitle1()
    {
        return $this->title1;
    }

    /**
     * Set title2
     *
     * @param string $title2
     *
     * @return Midyeartemplate
     */
    public function setTitle2($title2)
    {
        $this->title2 = $title2;

        return $this;
    }

    /**
     * Get title2
     *
     * @return string
     */
    public function getTitle2()
    {
        return $this->title2;
    }

    /**
     * Set title3
     *
     * @param string $title3
     *
     * @return Midyeartemplate
     */
    public function setTitle3($title3)
    {
        $this->title3 = $title3;

        return $this;
    }

    /**
     * Get title3
     *
     * @return string
     */
    public function getTitle3()
    {
        return $this->title3;
    }

    /**
     * Set title4
     *
     * @param string $title4
     *
     * @return Midyeartemplate
     */
    public function setTitle4($title4)
    {
        $this->title4 = $title4;

        return $this;
    }

    /**
     * Get title4
     *
     * @return string
     */
    public function getTitle4()
    {
        return $this->title4;
    }

    /**
     * Set smallTitle1
     *
     * @param string $smallTitle1
     *
     * @return Midyeartemplate
     */
    public function setSmallTitle1($smallTitle1)
    {
        $this->smallTitle1 = $smallTitle1;

        return $this;
    }

    /**
     * Get smallTitle1
     *
     * @return string
     */
    public function getSmallTitle1()
    {
        return $this->smallTitle1;
    }

    /**
     * Set smallTitle2
     *
     * @param string $smallTitle2
     *
     * @return Midyeartemplate
     */
    public function setSmallTitle2($smallTitle2)
    {
        $this->smallTitle2 = $smallTitle2;

        return $this;
    }

    /**
     * Get smallTitle2
     *
     * @return string
     */
    public function getSmallTitle2()
    {
        return $this->smallTitle2;
    }

    /**
     * Set smallTitle3
     *
     * @param string $smallTitle3
     *
     * @return Midyeartemplate
     */
    public function setSmallTitle3($smallTitle3)
    {
        $this->smallTitle3 = $smallTitle3;

        return $this;
    }

    /**
     * Get smallTitle3
     *
     * @return string
     */
    public function getSmallTitle3()
    {
        return $this->smallTitle3;
    }

    /**
     * Set isstandardtemplate
     *
     * @param boolean $isstandardtemplate
     *
     * @return Midyeartemplate
     */
    public function setIsstandardtemplate($isstandardtemplate)
    {
        $this->isstandardtemplate = $isstandardtemplate;

        return $this;
    }

    /**
     * Get isstandardtemplate
     *
     * @return boolean
     */
    public function getIsstandardtemplate()
    {
        return $this->isstandardtemplate;
    }

    /**
     * Set organizationfield
     *
     * @param string $organizationfield
     *
     * @return Midyeartemplate
     */
    public function setOrganizationfield($organizationfield)
    {
        $this->organizationfield = $organizationfield;

        return $this;
    }

    /**
     * Get organizationfield
     *
     * @return string
     */
    public function getOrganizationfield()
    {
        return $this->organizationfield;
    }

    /**
     * Set language
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Language $language
     *
     * @return Midyeartemplate
     */
    public function setLanguage(\IntoPeople\DatabaseBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
