<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Endyeartemplate
 *
 * @ORM\Table(name="EndYearTemplate", indexes={@ORM\Index(name="LanguageId", columns={"LanguageId"}), @ORM\Index(name="OrganizationId", columns={"OrganizationId"})})
 * @ORM\Entity(repositoryClass="IntoPeople\DatabaseBundle\Entity\EndyeartemplateRepository")
 */
class Endyeartemplate
{
    /**
     * @ORM\OneToMany(targetEntity="Endyear", mappedBy="endyeartemplate")
     */
    protected $endyears;
    
    public function __construct()
    {
        $this->endyears = new ArrayCollection();
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
     * @ORM\Column(name="Evaluation", type="text", length=65535, nullable=true)
     */
    private $evaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="EvaluationDescription", type="text", length=65535, nullable=true)
     */
    private $evaluationdescription;

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
     * @ORM\Column(name="FeedbackOrganization", type="text", length=65535, nullable=true)
     */
    private $feedbackorganization;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganizationDescription1", type="text", length=65535, nullable=true)
     */
    private $feedbackorganizationdescription1;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganizationDescription2", type="text", length=65535, nullable=true)
     */
    private $feedbackorganizationdescription2;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganizationDescription3", type="text", length=65535, nullable=true)
     */
    private $feedbackorganizationdescription3;

    /**
     * @var string
     *
     * @ORM\Column(name="FeedbackOrganizationDescription4", type="text", length=65535, nullable=true)
     */
    private $feedbackorganizationdescription4;

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
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * Set evaluation
     *
     * @param string $evaluation
     *
     * @return Endyeartemplate
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get evaluation
     *
     * @return string
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Set evaluationdescription
     *
     * @param string $evaluationdescription
     *
     * @return Endyeartemplate
     */
    public function setEvaluationdescription($evaluationdescription)
    {
        $this->evaluationdescription = $evaluationdescription;

        return $this;
    }

    /**
     * Get evaluationdescription
     *
     * @return string
     */
    public function getEvaluationdescription()
    {
        return $this->evaluationdescription;
    }

    /**
     * Set tasks
     *
     * @param string $tasks
     *
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * Set feedbackorganization
     *
     * @param string $feedbackorganization
     *
     * @return Endyeartemplate
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
     * Set feedbackorganizationdescription1
     *
     * @param string $feedbackorganizationdescription1
     *
     * @return Endyeartemplate
     */
    public function setFeedbackorganizationdescription1($feedbackorganizationdescription1)
    {
        $this->feedbackorganizationdescription1 = $feedbackorganizationdescription1;

        return $this;
    }

    /**
     * Get feedbackorganizationdescription1
     *
     * @return string
     */
    public function getFeedbackorganizationdescription1()
    {
        return $this->feedbackorganizationdescription1;
    }

    /**
     * Set feedbackorganizationdescription2
     *
     * @param string $feedbackorganizationdescription2
     *
     * @return Endyeartemplate
     */
    public function setFeedbackorganizationdescription2($feedbackorganizationdescription2)
    {
        $this->feedbackorganizationdescription2 = $feedbackorganizationdescription2;

        return $this;
    }

    /**
     * Get feedbackorganizationdescription2
     *
     * @return string
     */
    public function getFeedbackorganizationdescription2()
    {
        return $this->feedbackorganizationdescription2;
    }

    /**
     * Set feedbackorganizationdescription3
     *
     * @param string $feedbackorganizationdescription3
     *
     * @return Endyeartemplate
     */
    public function setFeedbackorganizationdescription3($feedbackorganizationdescription3)
    {
        $this->feedbackorganizationdescription3 = $feedbackorganizationdescription3;

        return $this;
    }

    /**
     * Get feedbackorganizationdescription3
     *
     * @return string
     */
    public function getFeedbackorganizationdescription3()
    {
        return $this->feedbackorganizationdescription3;
    }

    /**
     * Set feedbackorganizationdescription4
     *
     * @param string $feedbackorganizationdescription4
     *
     * @return Endyeartemplate
     */
    public function setFeedbackorganizationdescription4($feedbackorganizationdescription4)
    {
        $this->feedbackorganizationdescription4 = $feedbackorganizationdescription4;

        return $this;
    }

    /**
     * Get feedbackorganizationdescription4
     *
     * @return string
     */
    public function getFeedbackorganizationdescription4()
    {
        return $this->feedbackorganizationdescription4;
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
     * Add endyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyear
     *
     * @return Endyeartemplate
     */
    public function addEndyear(\IntoPeople\DatabaseBundle\Entity\Endyear $endyear)
    {
        $this->endyears[] = $endyear;

        return $this;
    }

    /**
     * Remove endyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyear
     */
    public function removeEndyear(\IntoPeople\DatabaseBundle\Entity\Endyear $endyear)
    {
        $this->endyears->removeElement($endyear);
    }

    /**
     * Get endyears
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEndyears()
    {
        return $this->endyears;
    }

    /**
     * Set isstandardtemplate
     *
     * @param boolean $isstandardtemplate
     *
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
