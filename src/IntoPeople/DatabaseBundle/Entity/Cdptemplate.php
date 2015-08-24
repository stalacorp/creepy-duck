<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cdptemplate
 *
 * @ORM\Table(name="CDPTemplate", indexes={@ORM\Index(name="LanguageId", columns={"LanguageId"}), @ORM\Index(name="OrganizationId", columns={"OrganizationId"})})
 * @ORM\Entity(repositoryClass="IntoPeople\DatabaseBundle\Entity\CdptemplateRepository")
 */
class Cdptemplate
{
    /**
     * @ORM\OneToMany(targetEntity="Cdp", mappedBy="cdptemplate")
     */
    protected $cdps;
    
    public function __construct()
    {
        $this->cdps = new ArrayCollection();
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
     * @ORM\Column(name="SelfAssesment", type="text", length=65535, nullable=true)
     */
    private $selfassesment;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SelfAssesmentDescription", type="text", length=65535, nullable=true)
     */
    private $selfassesmentDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="Talents", type="text", length=65535, nullable=true)
     */
    private $talents;
    
    /**
     * @var string
     *
     * @ORM\Column(name="TalentsDescription", type="text", length=65535, nullable=true)
     */
    private $talentsDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="Challenges", type="text", length=65535, nullable=true)
     */
    private $challenges;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ChallengesDescription", type="text", length=65535, nullable=true)
     */
    private $challengesDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="DevelopmentNeeds", type="text", length=65535, nullable=true)
     */
    private $developmentneeds;

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
    private $whatwhyDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="How", type="text", length=65535, nullable=true)
     */
    private $how;
    
    /**
     * @var string
     *
     * @ORM\Column(name="HowDescription", type="text", length=65535, nullable=true)
     */
    private $howDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="Success", type="text", length=65535, nullable=true)
     */
    private $success;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SuccessDescription", type="text", length=65535, nullable=true)
     */
    private $successDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="Needs", type="text", length=65535, nullable=true)
     */
    private $needs;
    
    /**
     * @var string
     *
     * @ORM\Column(name="NeedsDescription", type="text", length=65535, nullable=true)
     */
    private $needsDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="CareerObjectives", type="text", length=65535, nullable=true)
     */
    private $careerobjectives;
    
    /**
     * @var string
     *
     * @ORM\Column(name="CareerObjectivesQuestion", type="text", length=65535, nullable=true)
     */
    private $careerobjectivesQuestion;

    /**
     * @var string
     *
     * @ORM\Column(name="AdditionalInformation", type="text", length=65535, nullable=true)
     */
    private $additionalinformation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="AdditionalInformationQuestion", type="text", length=65535, nullable=true)
     */
    private $additionalinformationQuestion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SupervisorComment", type="text", length=65535, nullable=true)
     */
    private $supervisorComment;

    /**
     * @var string
     *
     * @ORM\Column(name="Feedback", type="text", length=65535, nullable=true)
     */
    private $feedback;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SignatureSupervisor", type="text", length=65535, nullable=true)
     */
    private $signatureSupervisor;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SignatureEmployee", type="text", length=65535, nullable=true)
     */
    private $signatureEmployee;
    
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
     * @return Cdptemplate
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
     * Set selfassesment
     *
     * @param string $selfassesment
     *
     * @return Cdptemplate
     */
    public function setSelfassesment($selfassesment)
    {
        $this->selfassesment = $selfassesment;

        return $this;
    }

    /**
     * Get selfassesment
     *
     * @return string
     */
    public function getSelfassesment()
    {
        return $this->selfassesment;
    }

    /**
     * Set talents
     *
     * @param string $talents
     *
     * @return Cdptemplate
     */
    public function setTalents($talents)
    {
        $this->talents = $talents;

        return $this;
    }

    /**
     * Get talents
     *
     * @return string
     */
    public function getTalents()
    {
        return $this->talents;
    }

    /**
     * Set challenges
     *
     * @param string $challenges
     *
     * @return Cdptemplate
     */
    public function setChallenges($challenges)
    {
        $this->challenges = $challenges;

        return $this;
    }

    /**
     * Get challenges
     *
     * @return string
     */
    public function getChallenges()
    {
        return $this->challenges;
    }

    /**
     * Set developmentneeds
     *
     * @param string $developmentneeds
     *
     * @return Cdptemplate
     */
    public function setDevelopmentneeds($developmentneeds)
    {
        $this->developmentneeds = $developmentneeds;

        return $this;
    }

    /**
     * Get developmentneeds
     *
     * @return string
     */
    public function getDevelopmentneeds()
    {
        return $this->developmentneeds;
    }

    /**
     * Set whatwhy
     *
     * @param string $whatwhy
     *
     * @return Cdptemplate
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
     * Set how
     *
     * @param string $how
     *
     * @return Cdptemplate
     */
    public function setHow($how)
    {
        $this->how = $how;

        return $this;
    }

    /**
     * Get how
     *
     * @return string
     */
    public function getHow()
    {
        return $this->how;
    }

    /**
     * Set success
     *
     * @param string $success
     *
     * @return Cdptemplate
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Get success
     *
     * @return string
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Set needs
     *
     * @param string $needs
     *
     * @return Cdptemplate
     */
    public function setNeeds($needs)
    {
        $this->needs = $needs;

        return $this;
    }

    /**
     * Get needs
     *
     * @return string
     */
    public function getNeeds()
    {
        return $this->needs;
    }

    /**
     * Set careerobjectives
     *
     * @param string $careerobjectives
     *
     * @return Cdptemplate
     */
    public function setCareerobjectives($careerobjectives)
    {
        $this->careerobjectives = $careerobjectives;

        return $this;
    }

    /**
     * Get careerobjectives
     *
     * @return string
     */
    public function getCareerobjectives()
    {
        return $this->careerobjectives;
    }

    /**
     * Set additionalinformation
     *
     * @param string $additionalinformation
     *
     * @return Cdptemplate
     */
    public function setAdditionalinformation($additionalinformation)
    {
        $this->additionalinformation = $additionalinformation;

        return $this;
    }

    /**
     * Get additionalinformation
     *
     * @return string
     */
    public function getAdditionalinformation()
    {
        return $this->additionalinformation;
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
     * Add cdp
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdp
     *
     * @return Cdptemplate
     */
    public function addCdp(\IntoPeople\DatabaseBundle\Entity\Cdp $cdp)
    {
        $this->cdps[] = $cdp;

        return $this;
    }

    /**
     * Remove cdp
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdp
     */
    public function removeCdp(\IntoPeople\DatabaseBundle\Entity\Cdp $cdp)
    {
        $this->cdps->removeElement($cdp);
    }

    /**
     * Get cdps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdps()
    {
        return $this->cdps;
    }

    /**
     * Set organization
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Organization $organization
     *
     * @return Cdptemplate
     */
    public function setOrganization(\IntoPeople\DatabaseBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set selfassesmentDescription
     *
     * @param string $selfassesmentDescription
     *
     * @return Cdptemplate
     */
    public function setSelfassesmentDescription($selfassesmentDescription)
    {
        $this->selfassesmentDescription = $selfassesmentDescription;

        return $this;
    }

    /**
     * Get selfassesmentDescription
     *
     * @return string
     */
    public function getSelfassesmentDescription()
    {
        return $this->selfassesmentDescription;
    }

    /**
     * Set talentsDescription
     *
     * @param string $talentsDescription
     *
     * @return Cdptemplate
     */
    public function setTalentsDescription($talentsDescription)
    {
        $this->talentsDescription = $talentsDescription;

        return $this;
    }

    /**
     * Get talentsDescription
     *
     * @return string
     */
    public function getTalentsDescription()
    {
        return $this->talentsDescription;
    }

    /**
     * Set challengesDescription
     *
     * @param string $challengesDescription
     *
     * @return Cdptemplate
     */
    public function setChallengesDescription($challengesDescription)
    {
        $this->challengesDescription = $challengesDescription;

        return $this;
    }

    /**
     * Get challengesDescription
     *
     * @return string
     */
    public function getChallengesDescription()
    {
        return $this->challengesDescription;
    }

    /**
     * Set whatwhyDescription
     *
     * @param string $whatwhyDescription
     *
     * @return Cdptemplate
     */
    public function setWhatwhyDescription($whatwhyDescription)
    {
        $this->whatwhyDescription = $whatwhyDescription;

        return $this;
    }

    /**
     * Get whatwhyDescription
     *
     * @return string
     */
    public function getWhatwhyDescription()
    {
        return $this->whatwhyDescription;
    }

    /**
     * Set howDescription
     *
     * @param string $howDescription
     *
     * @return Cdptemplate
     */
    public function setHowDescription($howDescription)
    {
        $this->howDescription = $howDescription;

        return $this;
    }

    /**
     * Get howDescription
     *
     * @return string
     */
    public function getHowDescription()
    {
        return $this->howDescription;
    }

    /**
     * Set successDescription
     *
     * @param string $successDescription
     *
     * @return Cdptemplate
     */
    public function setSuccessDescription($successDescription)
    {
        $this->successDescription = $successDescription;

        return $this;
    }

    /**
     * Get successDescription
     *
     * @return string
     */
    public function getSuccessDescription()
    {
        return $this->successDescription;
    }

    /**
     * Set needsDescription
     *
     * @param string $needsDescription
     *
     * @return Cdptemplate
     */
    public function setNeedsDescription($needsDescription)
    {
        $this->needsDescription = $needsDescription;

        return $this;
    }

    /**
     * Get needsDescription
     *
     * @return string
     */
    public function getNeedsDescription()
    {
        return $this->needsDescription;
    }

    /**
     * Set careerobjectivesQuestion
     *
     * @param string $careerobjectivesQuestion
     *
     * @return Cdptemplate
     */
    public function setCareerobjectivesQuestion($careerobjectivesQuestion)
    {
        $this->careerobjectivesQuestion = $careerobjectivesQuestion;

        return $this;
    }

    /**
     * Get careerobjectivesQuestion
     *
     * @return string
     */
    public function getCareerobjectivesQuestion()
    {
        return $this->careerobjectivesQuestion;
    }

    /**
     * Set additionalinformationQuestion
     *
     * @param string $additionalinformationQuestion
     *
     * @return Cdptemplate
     */
    public function setAdditionalinformationQuestion($additionalinformationQuestion)
    {
        $this->additionalinformationQuestion = $additionalinformationQuestion;

        return $this;
    }

    /**
     * Get additionalinformationQuestion
     *
     * @return string
     */
    public function getAdditionalinformationQuestion()
    {
        return $this->additionalinformationQuestion;
    }

    /**
     * Set supervisorComment
     *
     * @param string $supervisorComment
     *
     * @return Cdptemplate
     */
    public function setSupervisorComment($supervisorComment)
    {
        $this->supervisorComment = $supervisorComment;

        return $this;
    }

    /**
     * Get supervisorComment
     *
     * @return string
     */
    public function getSupervisorComment()
    {
        return $this->supervisorComment;
    }

    /**
     * Set feedback
     *
     * @param string $feedback
     *
     * @return Cdptemplate
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get feedback
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Set signatureSupervisor
     *
     * @param string $signatureSupervisor
     *
     * @return Cdptemplate
     */
    public function setSignatureSupervisor($signatureSupervisor)
    {
        $this->signatureSupervisor = $signatureSupervisor;

        return $this;
    }

    /**
     * Get signatureSupervisor
     *
     * @return string
     */
    public function getSignatureSupervisor()
    {
        return $this->signatureSupervisor;
    }

    /**
     * Set signatureEmployee
     *
     * @param string $signatureEmployee
     *
     * @return Cdptemplate
     */
    public function setSignatureEmployee($signatureEmployee)
    {
        $this->signatureEmployee = $signatureEmployee;

        return $this;
    }

    /**
     * Get signatureEmployee
     *
     * @return string
     */
    public function getSignatureEmployee()
    {
        return $this->signatureEmployee;
    }

    /**
     * Set language
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Language $language
     *
     * @return Cdptemplate
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

    /**
     * Set isstandardtemplate
     *
     * @param boolean $isstandardtemplate
     *
     * @return Cdptemplate
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
}
