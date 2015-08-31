<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cdp
 *
 * @ORM\Table(name="CDP", indexes={@ORM\Index(name="FormStatusId", columns={"FormStatusId"}), @ORM\Index(name="SupervisorId", columns={"SupervisorId"}), @ORM\Index(name="DevelopmentNeedsId", columns={"DevelopmentNeedsId"}), @ORM\Index(name="CDPTemplateId", columns={"CDPTemplateId"})})
 * @ORM\Entity
 */
class Cdp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Developmentneeds
     *
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Developmentneeds", cascade={"persist"}, inversedBy="cdp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DevelopmentNeedsId", referencedColumnName="Id")
     * })
     */
    private $developmentneeds;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SupervisorId", referencedColumnName="Id")
     * })
     */
    private $supervisor;


    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Formstatus
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Formstatus", inversedBy="cdps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FormStatusId", referencedColumnName="Id")
     * })
     */
    private $formstatus;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Cdptemplate
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdptemplate", inversedBy="cdps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CDPTemplateId", referencedColumnName="Id")
     * })
     */
    private $cdptemplate;

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdphistory", cascade={"persist"}, mappedBy="cdp")
     */
    protected $cdphistories;

    public function __construct1()
    {
        $this->cdphistories = new ArrayCollection();
    }

    /**
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Feedbackcycle", mappedBy="cdp")
     */
    protected $feedbackcycle;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Corequality
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Corequality", inversedBy="corequality1")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Corequality1Id", referencedColumnName="Id")
     * })
     */
    private $corequality1;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Corequality
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Corequality", inversedBy="corequality2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Corequality2Id", referencedColumnName="Id")
     * })
     */
    private $corequality2;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Corequality
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Corequality", inversedBy="corequality3")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Corequality3Id", referencedColumnName="Id")
     * })
     */
    private $corequality3;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Corequality
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Corequality", inversedBy="corequality4")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Corequality4Id", referencedColumnName="Id")
     * })
     */
    private $corequality4;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Corequality
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Corequality", inversedBy="corequality5")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Corequality5Id", referencedColumnName="Id")
     * })
     */
    private $corequality5;


    
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
     * @ORM\Column(name="Talent1", type="text", length=65535, nullable=true)
     */
    private $talent1;

    /**
     * @var string
     *
     * @ORM\Column(name="Talent2", type="text", length=65535, nullable=true)
     */
    private $talent2;

    /**
     * @var string
     *
     * @ORM\Column(name="Talent3", type="text", length=65535, nullable=true)
     */
    private $talent3;

    /**
     * @var string
     *
     * @ORM\Column(name="Talent4", type="text", length=65535, nullable=true)
     */
    private $talent4;

    /**
     * @var string
     *
     * @ORM\Column(name="Talent5", type="text", length=65535, nullable=true)
     */
    private $talent5;

    /**
     * @var string
     *
     * @ORM\Column(name="TalentWhy1", type="text", length=65535, nullable=true)
     */
    private $talentwhy1;

    /**
     * @var string
     *
     * @ORM\Column(name="TalentWhy2", type="text", length=65535, nullable=true)
     */
    private $talentwhy2;

    /**
     * @var string
     *
     * @ORM\Column(name="TalentWhy3", type="text", length=65535, nullable=true)
     */
    private $talentwhy3;

    /**
     * @var string
     *
     * @ORM\Column(name="TalentWhy4", type="text", length=65535, nullable=true)
     */
    private $talentwhy4;

    /**
     * @var string
     *
     * @ORM\Column(name="TalentWhy5", type="text", length=65535, nullable=true)
     */
    private $talentwhy5;

    /**
     * @var string
     *
     * @ORM\Column(name="Challenge1", type="text", length=65535, nullable=true)
     */
    private $challenge1;

    /**
     * @var string
     *
     * @ORM\Column(name="Challenge2", type="text", length=65535, nullable=true)
     */
    private $challenge2;

    /**
     * @var string
     *
     * @ORM\Column(name="Challenge3", type="text", length=65535, nullable=true)
     */
    private $challenge3;

    /**
     * @var string
     *
     * @ORM\Column(name="Challenge4", type="text", length=65535, nullable=true)
     */
    private $challenge4;

    /**
     * @var string
     *
     * @ORM\Column(name="Challenge5", type="text", length=65535, nullable=true)
     */
    private $challenge5;

    /**
     * @var string
     *
     * @ORM\Column(name="ChallengeWhy1", type="text", length=65535, nullable=true)
     */
    private $challengewhy1;

    /**
     * @var string
     *
     * @ORM\Column(name="ChallengeWhy2", type="text", length=65535, nullable=true)
     */
    private $challengewhy2;

    /**
     * @var string
     *
     * @ORM\Column(name="ChallengeWhy3", type="text", length=65535, nullable=true)
     */
    private $challengewhy3;

    /**
     * @var string
     *
     * @ORM\Column(name="ChallengeWhy4", type="text", length=65535, nullable=true)
     */
    private $challengewhy4;

    /**
     * @var string
     *
     * @ORM\Column(name="ChallengeWhy5", type="text", length=65535, nullable=true)
     */
    private $challengewhy5;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskHow1", type="text", length=65535, nullable=true)
     */
    private $taskhow1;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskHow2", type="text", length=65535, nullable=true)
     */
    private $taskhow2;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskHow3", type="text", length=65535, nullable=true)
     */
    private $taskhow3;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskHow4", type="text", length=65535, nullable=true)
     */
    private $taskhow4;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskHow5", type="text", length=65535, nullable=true)
     */
    private $taskhow5;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskSucces1", type="text", length=65535, nullable=true)
     */
    private $tasksucces1;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskSucces2", type="text", length=65535, nullable=true)
     */
    private $tasksucces2;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskSucces3", type="text", length=65535, nullable=true)
     */
    private $tasksucces3;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskSucces4", type="text", length=65535, nullable=true)
     */
    private $tasksucces4;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskSucces5", type="text", length=65535, nullable=true)
     */
    private $tasksucces5;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskNeeds1", type="text", length=65535, nullable=true)
     */
    private $taskneeds1;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskNeeds2", type="text", length=65535, nullable=true)
     */
    private $taskneeds2;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskNeeds3", type="text", length=65535, nullable=true)
     */
    private $taskneeds3;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskNeeds4", type="text", length=65535, nullable=true)
     */
    private $taskneeds4;

    /**
     * @var string
     *
     * @ORM\Column(name="TaskNeeds5", type="text", length=65535, nullable=true)
     */
    private $taskneeds5;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsHow1", type="text", length=65535, nullable=true)
     */
    private $skillshow1;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsHow2", type="text", length=65535, nullable=true)
     */
    private $skillshow2;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsHow3", type="text", length=65535, nullable=true)
     */
    private $skillshow3;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsHow4", type="text", length=65535, nullable=true)
     */
    private $skillshow4;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsHow5", type="text", length=65535, nullable=true)
     */
    private $skillshow5;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsSuccess1", type="text", length=65535, nullable=true)
     */
    private $skillssuccess1;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsSucces2", type="text", length=65535, nullable=true)
     */
    private $skillssucces2;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsSucces3", type="text", length=65535, nullable=true)
     */
    private $skillssucces3;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsSucces4", type="text", length=65535, nullable=true)
     */
    private $skillssucces4;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsSucces5", type="text", length=65535, nullable=true)
     */
    private $skillssucces5;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsNeeds1", type="text", length=65535, nullable=true)
     */
    private $skillsneeds1;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsNeeds2", type="text", length=65535, nullable=true)
     */
    private $skillsneeds2;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsNeeds3", type="text", length=65535, nullable=true)
     */
    private $skillsneeds3;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsNeeds4", type="text", length=65535, nullable=true)
     */
    private $skillsneeds4;

    /**
     * @var string
     *
     * @ORM\Column(name="SkillsNeeds5", type="text", length=65535, nullable=true)
     */
    private $skillsneeds5;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationHow1", type="text", length=65535, nullable=true)
     */
    private $organizationhow1;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationHow2", type="text", length=65535, nullable=true)
     */
    private $organizationhow2;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationHow3", type="text", length=65535, nullable=true)
     */
    private $organizationhow3;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationHow4", type="text", length=65535, nullable=true)
     */
    private $organizationhow4;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationHow5", type="text", length=65535, nullable=true)
     */
    private $organizationhow5;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationSuccess1", type="text", length=65535, nullable=true)
     */
    private $organizationsuccess1;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationSuccess2", type="text", length=65535, nullable=true)
     */
    private $organizationsuccess2;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationSuccess3", type="text", length=65535, nullable=true)
     */
    private $organizationsuccess3;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationSuccess4", type="text", length=65535, nullable=true)
     */
    private $organizationsuccess4;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationSuccess5", type="text", length=65535, nullable=true)
     */
    private $organizationsuccess5;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationNeeds1", type="text", length=65535, nullable=true)
     */
    private $organizationneeds1;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationNeeds2", type="text", length=65535, nullable=true)
     */
    private $organizationneeds2;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationNeeds3", type="text", length=65535, nullable=true)
     */
    private $organizationneeds3;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationNeeds4", type="text", length=65535, nullable=true)
     */
    private $organizationneeds4;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationNeeds5", type="text", length=65535, nullable=true)
     */
    private $organizationneeds5;

    /**
     * @var string
     *
     * @ORM\Column(name="CareerObjective", type="text", length=65535, nullable=true)
     */
    private $careerobjective;

    /**
     * @var string
     *
     * @ORM\Column(name="AdditionalInformation", type="text", length=65535, nullable=true)
     */
    private $additionalinformation;

    /**
     * Set datesubmitted
     *
     * @param \DateTime $datesubmitted
     *
     * @return Cdp
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
     * @return Cdp
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
     * @return Cdp
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
     * @return Cdp
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
     * @return Cdp
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
     * @return Cdp
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
     * Set talent1
     *
     * @param string $talent1
     *
     * @return Cdp
     */
    public function setTalent1($talent1)
    {
        $this->talent1 = $talent1;

        return $this;
    }

    /**
     * Get talent1
     *
     * @return string
     */
    public function getTalent1()
    {
        return $this->talent1;
    }

    /**
     * Set talent2
     *
     * @param string $talent2
     *
     * @return Cdp
     */
    public function setTalent2($talent2)
    {
        $this->talent2 = $talent2;

        return $this;
    }

    /**
     * Get talent2
     *
     * @return string
     */
    public function getTalent2()
    {
        return $this->talent2;
    }

    /**
     * Set talent3
     *
     * @param string $talent3
     *
     * @return Cdp
     */
    public function setTalent3($talent3)
    {
        $this->talent3 = $talent3;

        return $this;
    }

    /**
     * Get talent3
     *
     * @return string
     */
    public function getTalent3()
    {
        return $this->talent3;
    }

    /**
     * Set talent4
     *
     * @param string $talent4
     *
     * @return Cdp
     */
    public function setTalent4($talent4)
    {
        $this->talent4 = $talent4;

        return $this;
    }

    /**
     * Get talent4
     *
     * @return string
     */
    public function getTalent4()
    {
        return $this->talent4;
    }

    /**
     * Set talent5
     *
     * @param string $talent5
     *
     * @return Cdp
     */
    public function setTalent5($talent5)
    {
        $this->talent5 = $talent5;

        return $this;
    }

    /**
     * Get talent5
     *
     * @return string
     */
    public function getTalent5()
    {
        return $this->talent5;
    }

    /**
     * Set talentwhy1
     *
     * @param string $talentwhy1
     *
     * @return Cdp
     */
    public function setTalentwhy1($talentwhy1)
    {
        $this->talentwhy1 = $talentwhy1;

        return $this;
    }

    /**
     * Get talentwhy1
     *
     * @return string
     */
    public function getTalentwhy1()
    {
        return $this->talentwhy1;
    }

    /**
     * Set talentwhy2
     *
     * @param string $talentwhy2
     *
     * @return Cdp
     */
    public function setTalentwhy2($talentwhy2)
    {
        $this->talentwhy2 = $talentwhy2;

        return $this;
    }

    /**
     * Get talentwhy2
     *
     * @return string
     */
    public function getTalentwhy2()
    {
        return $this->talentwhy2;
    }

    /**
     * Set talentwhy3
     *
     * @param string $talentwhy3
     *
     * @return Cdp
     */
    public function setTalentwhy3($talentwhy3)
    {
        $this->talentwhy3 = $talentwhy3;

        return $this;
    }

    /**
     * Get talentwhy3
     *
     * @return string
     */
    public function getTalentwhy3()
    {
        return $this->talentwhy3;
    }

    /**
     * Set talentwhy4
     *
     * @param string $talentwhy4
     *
     * @return Cdp
     */
    public function setTalentwhy4($talentwhy4)
    {
        $this->talentwhy4 = $talentwhy4;

        return $this;
    }

    /**
     * Get talentwhy4
     *
     * @return string
     */
    public function getTalentwhy4()
    {
        return $this->talentwhy4;
    }

    /**
     * Set talentwhy5
     *
     * @param string $talentwhy5
     *
     * @return Cdp
     */
    public function setTalentwhy5($talentwhy5)
    {
        $this->talentwhy5 = $talentwhy5;

        return $this;
    }

    /**
     * Get talentwhy5
     *
     * @return string
     */
    public function getTalentwhy5()
    {
        return $this->talentwhy5;
    }

    /**
     * Set challenge1
     *
     * @param string $challenge1
     *
     * @return Cdp
     */
    public function setChallenge1($challenge1)
    {
        $this->challenge1 = $challenge1;

        return $this;
    }

    /**
     * Get challenge1
     *
     * @return string
     */
    public function getChallenge1()
    {
        return $this->challenge1;
    }

    /**
     * Set challenge2
     *
     * @param string $challenge2
     *
     * @return Cdp
     */
    public function setChallenge2($challenge2)
    {
        $this->challenge2 = $challenge2;

        return $this;
    }

    /**
     * Get challenge2
     *
     * @return string
     */
    public function getChallenge2()
    {
        return $this->challenge2;
    }

    /**
     * Set challenge3
     *
     * @param string $challenge3
     *
     * @return Cdp
     */
    public function setChallenge3($challenge3)
    {
        $this->challenge3 = $challenge3;

        return $this;
    }

    /**
     * Get challenge3
     *
     * @return string
     */
    public function getChallenge3()
    {
        return $this->challenge3;
    }

    /**
     * Set challenge4
     *
     * @param string $challenge4
     *
     * @return Cdp
     */
    public function setChallenge4($challenge4)
    {
        $this->challenge4 = $challenge4;

        return $this;
    }

    /**
     * Get challenge4
     *
     * @return string
     */
    public function getChallenge4()
    {
        return $this->challenge4;
    }

    /**
     * Set challenge5
     *
     * @param string $challenge5
     *
     * @return Cdp
     */
    public function setChallenge5($challenge5)
    {
        $this->challenge5 = $challenge5;

        return $this;
    }

    /**
     * Get challenge5
     *
     * @return string
     */
    public function getChallenge5()
    {
        return $this->challenge5;
    }

    /**
     * Set challengewhy1
     *
     * @param string $challengewhy1
     *
     * @return Cdp
     */
    public function setChallengewhy1($challengewhy1)
    {
        $this->challengewhy1 = $challengewhy1;

        return $this;
    }

    /**
     * Get challengewhy1
     *
     * @return string
     */
    public function getChallengewhy1()
    {
        return $this->challengewhy1;
    }

    /**
     * Set challengewhy2
     *
     * @param string $challengewhy2
     *
     * @return Cdp
     */
    public function setChallengewhy2($challengewhy2)
    {
        $this->challengewhy2 = $challengewhy2;

        return $this;
    }

    /**
     * Get challengewhy2
     *
     * @return string
     */
    public function getChallengewhy2()
    {
        return $this->challengewhy2;
    }

    /**
     * Set challengewhy3
     *
     * @param string $challengewhy3
     *
     * @return Cdp
     */
    public function setChallengewhy3($challengewhy3)
    {
        $this->challengewhy3 = $challengewhy3;

        return $this;
    }

    /**
     * Get challengewhy3
     *
     * @return string
     */
    public function getChallengewhy3()
    {
        return $this->challengewhy3;
    }

    /**
     * Set challengewhy4
     *
     * @param string $challengewhy4
     *
     * @return Cdp
     */
    public function setChallengewhy4($challengewhy4)
    {
        $this->challengewhy4 = $challengewhy4;

        return $this;
    }

    /**
     * Get challengewhy4
     *
     * @return string
     */
    public function getChallengewhy4()
    {
        return $this->challengewhy4;
    }

    /**
     * Set challengewhy5
     *
     * @param string $challengewhy5
     *
     * @return Cdp
     */
    public function setChallengewhy5($challengewhy5)
    {
        $this->challengewhy5 = $challengewhy5;

        return $this;
    }

    /**
     * Get challengewhy5
     *
     * @return string
     */
    public function getChallengewhy5()
    {
        return $this->challengewhy5;
    }

    /**
     * Set taskhow1
     *
     * @param string $taskhow1
     *
     * @return Cdp
     */
    public function setTaskhow1($taskhow1)
    {
        $this->taskhow1 = $taskhow1;

        return $this;
    }

    /**
     * Get taskhow1
     *
     * @return string
     */
    public function getTaskhow1()
    {
        return $this->taskhow1;
    }

    /**
     * Set taskhow2
     *
     * @param string $taskhow2
     *
     * @return Cdp
     */
    public function setTaskhow2($taskhow2)
    {
        $this->taskhow2 = $taskhow2;

        return $this;
    }

    /**
     * Get taskhow2
     *
     * @return string
     */
    public function getTaskhow2()
    {
        return $this->taskhow2;
    }

    /**
     * Set taskhow3
     *
     * @param string $taskhow3
     *
     * @return Cdp
     */
    public function setTaskhow3($taskhow3)
    {
        $this->taskhow3 = $taskhow3;

        return $this;
    }

    /**
     * Get taskhow3
     *
     * @return string
     */
    public function getTaskhow3()
    {
        return $this->taskhow3;
    }

    /**
     * Set taskhow4
     *
     * @param string $taskhow4
     *
     * @return Cdp
     */
    public function setTaskhow4($taskhow4)
    {
        $this->taskhow4 = $taskhow4;

        return $this;
    }

    /**
     * Get taskhow4
     *
     * @return string
     */
    public function getTaskhow4()
    {
        return $this->taskhow4;
    }

    /**
     * Set taskhow5
     *
     * @param string $taskhow5
     *
     * @return Cdp
     */
    public function setTaskhow5($taskhow5)
    {
        $this->taskhow5 = $taskhow5;

        return $this;
    }

    /**
     * Get taskhow5
     *
     * @return string
     */
    public function getTaskhow5()
    {
        return $this->taskhow5;
    }

    /**
     * Set tasksucces1
     *
     * @param string $tasksucces1
     *
     * @return Cdp
     */
    public function setTasksucces1($tasksucces1)
    {
        $this->tasksucces1 = $tasksucces1;

        return $this;
    }

    /**
     * Get tasksucces1
     *
     * @return string
     */
    public function getTasksucces1()
    {
        return $this->tasksucces1;
    }

    /**
     * Set tasksucces2
     *
     * @param string $tasksucces2
     *
     * @return Cdp
     */
    public function setTasksucces2($tasksucces2)
    {
        $this->tasksucces2 = $tasksucces2;

        return $this;
    }

    /**
     * Get tasksucces2
     *
     * @return string
     */
    public function getTasksucces2()
    {
        return $this->tasksucces2;
    }

    /**
     * Set tasksucces3
     *
     * @param string $tasksucces3
     *
     * @return Cdp
     */
    public function setTasksucces3($tasksucces3)
    {
        $this->tasksucces3 = $tasksucces3;

        return $this;
    }

    /**
     * Get tasksucces3
     *
     * @return string
     */
    public function getTasksucces3()
    {
        return $this->tasksucces3;
    }

    /**
     * Set tasksucces4
     *
     * @param string $tasksucces4
     *
     * @return Cdp
     */
    public function setTasksucces4($tasksucces4)
    {
        $this->tasksucces4 = $tasksucces4;

        return $this;
    }

    /**
     * Get tasksucces4
     *
     * @return string
     */
    public function getTasksucces4()
    {
        return $this->tasksucces4;
    }

    /**
     * Set tasksucces5
     *
     * @param string $tasksucces5
     *
     * @return Cdp
     */
    public function setTasksucces5($tasksucces5)
    {
        $this->tasksucces5 = $tasksucces5;

        return $this;
    }

    /**
     * Get tasksucces5
     *
     * @return string
     */
    public function getTasksucces5()
    {
        return $this->tasksucces5;
    }

    /**
     * Set taskneeds1
     *
     * @param string $taskneeds1
     *
     * @return Cdp
     */
    public function setTaskneeds1($taskneeds1)
    {
        $this->taskneeds1 = $taskneeds1;

        return $this;
    }

    /**
     * Get taskneeds1
     *
     * @return string
     */
    public function getTaskneeds1()
    {
        return $this->taskneeds1;
    }

    /**
     * Set taskneeds2
     *
     * @param string $taskneeds2
     *
     * @return Cdp
     */
    public function setTaskneeds2($taskneeds2)
    {
        $this->taskneeds2 = $taskneeds2;

        return $this;
    }

    /**
     * Get taskneeds2
     *
     * @return string
     */
    public function getTaskneeds2()
    {
        return $this->taskneeds2;
    }

    /**
     * Set taskneeds3
     *
     * @param string $taskneeds3
     *
     * @return Cdp
     */
    public function setTaskneeds3($taskneeds3)
    {
        $this->taskneeds3 = $taskneeds3;

        return $this;
    }

    /**
     * Get taskneeds3
     *
     * @return string
     */
    public function getTaskneeds3()
    {
        return $this->taskneeds3;
    }

    /**
     * Set taskneeds4
     *
     * @param string $taskneeds4
     *
     * @return Cdp
     */
    public function setTaskneeds4($taskneeds4)
    {
        $this->taskneeds4 = $taskneeds4;

        return $this;
    }

    /**
     * Get taskneeds4
     *
     * @return string
     */
    public function getTaskneeds4()
    {
        return $this->taskneeds4;
    }

    /**
     * Set taskneeds5
     *
     * @param string $taskneeds5
     *
     * @return Cdp
     */
    public function setTaskneeds5($taskneeds5)
    {
        $this->taskneeds5 = $taskneeds5;

        return $this;
    }

    /**
     * Get taskneeds5
     *
     * @return string
     */
    public function getTaskneeds5()
    {
        return $this->taskneeds5;
    }

    /**
     * Set skillshow1
     *
     * @param string $skillshow1
     *
     * @return Cdp
     */
    public function setSkillshow1($skillshow1)
    {
        $this->skillshow1 = $skillshow1;

        return $this;
    }

    /**
     * Get skillshow1
     *
     * @return string
     */
    public function getSkillshow1()
    {
        return $this->skillshow1;
    }

    /**
     * Set skillshow2
     *
     * @param string $skillshow2
     *
     * @return Cdp
     */
    public function setSkillshow2($skillshow2)
    {
        $this->skillshow2 = $skillshow2;

        return $this;
    }

    /**
     * Get skillshow2
     *
     * @return string
     */
    public function getSkillshow2()
    {
        return $this->skillshow2;
    }

    /**
     * Set skillshow3
     *
     * @param string $skillshow3
     *
     * @return Cdp
     */
    public function setSkillshow3($skillshow3)
    {
        $this->skillshow3 = $skillshow3;

        return $this;
    }

    /**
     * Get skillshow3
     *
     * @return string
     */
    public function getSkillshow3()
    {
        return $this->skillshow3;
    }

    /**
     * Set skillshow4
     *
     * @param string $skillshow4
     *
     * @return Cdp
     */
    public function setSkillshow4($skillshow4)
    {
        $this->skillshow4 = $skillshow4;

        return $this;
    }

    /**
     * Get skillshow4
     *
     * @return string
     */
    public function getSkillshow4()
    {
        return $this->skillshow4;
    }

    /**
     * Set skillshow5
     *
     * @param string $skillshow5
     *
     * @return Cdp
     */
    public function setSkillshow5($skillshow5)
    {
        $this->skillshow5 = $skillshow5;

        return $this;
    }

    /**
     * Get skillshow5
     *
     * @return string
     */
    public function getSkillshow5()
    {
        return $this->skillshow5;
    }

    /**
     * Set skillssuccess1
     *
     * @param string $skillssuccess1
     *
     * @return Cdp
     */
    public function setSkillssuccess1($skillssuccess1)
    {
        $this->skillssuccess1 = $skillssuccess1;

        return $this;
    }

    /**
     * Get skillssuccess1
     *
     * @return string
     */
    public function getSkillssuccess1()
    {
        return $this->skillssuccess1;
    }

    /**
     * Set skillssucces2
     *
     * @param string $skillssucces2
     *
     * @return Cdp
     */
    public function setSkillssucces2($skillssucces2)
    {
        $this->skillssucces2 = $skillssucces2;

        return $this;
    }

    /**
     * Get skillssucces2
     *
     * @return string
     */
    public function getSkillssucces2()
    {
        return $this->skillssucces2;
    }

    /**
     * Set skillssucces3
     *
     * @param string $skillssucces3
     *
     * @return Cdp
     */
    public function setSkillssucces3($skillssucces3)
    {
        $this->skillssucces3 = $skillssucces3;

        return $this;
    }

    /**
     * Get skillssucces3
     *
     * @return string
     */
    public function getSkillssucces3()
    {
        return $this->skillssucces3;
    }

    /**
     * Set skillssucces4
     *
     * @param string $skillssucces4
     *
     * @return Cdp
     */
    public function setSkillssucces4($skillssucces4)
    {
        $this->skillssucces4 = $skillssucces4;

        return $this;
    }

    /**
     * Get skillssucces4
     *
     * @return string
     */
    public function getSkillssucces4()
    {
        return $this->skillssucces4;
    }

    /**
     * Set skillssucces5
     *
     * @param string $skillssucces5
     *
     * @return Cdp
     */
    public function setSkillssucces5($skillssucces5)
    {
        $this->skillssucces5 = $skillssucces5;

        return $this;
    }

    /**
     * Get skillssucces5
     *
     * @return string
     */
    public function getSkillssucces5()
    {
        return $this->skillssucces5;
    }

    /**
     * Set skillsneeds1
     *
     * @param string $skillsneeds1
     *
     * @return Cdp
     */
    public function setSkillsneeds1($skillsneeds1)
    {
        $this->skillsneeds1 = $skillsneeds1;

        return $this;
    }

    /**
     * Get skillsneeds1
     *
     * @return string
     */
    public function getSkillsneeds1()
    {
        return $this->skillsneeds1;
    }

    /**
     * Set skillsneeds2
     *
     * @param string $skillsneeds2
     *
     * @return Cdp
     */
    public function setSkillsneeds2($skillsneeds2)
    {
        $this->skillsneeds2 = $skillsneeds2;

        return $this;
    }

    /**
     * Get skillsneeds2
     *
     * @return string
     */
    public function getSkillsneeds2()
    {
        return $this->skillsneeds2;
    }

    /**
     * Set skillsneeds3
     *
     * @param string $skillsneeds3
     *
     * @return Cdp
     */
    public function setSkillsneeds3($skillsneeds3)
    {
        $this->skillsneeds3 = $skillsneeds3;

        return $this;
    }

    /**
     * Get skillsneeds3
     *
     * @return string
     */
    public function getSkillsneeds3()
    {
        return $this->skillsneeds3;
    }

    /**
     * Set skillsneeds4
     *
     * @param string $skillsneeds4
     *
     * @return Cdp
     */
    public function setSkillsneeds4($skillsneeds4)
    {
        $this->skillsneeds4 = $skillsneeds4;

        return $this;
    }

    /**
     * Get skillsneeds4
     *
     * @return string
     */
    public function getSkillsneeds4()
    {
        return $this->skillsneeds4;
    }

    /**
     * Set skillsneeds5
     *
     * @param string $skillsneeds5
     *
     * @return Cdp
     */
    public function setSkillsneeds5($skillsneeds5)
    {
        $this->skillsneeds5 = $skillsneeds5;

        return $this;
    }

    /**
     * Get skillsneeds5
     *
     * @return string
     */
    public function getSkillsneeds5()
    {
        return $this->skillsneeds5;
    }

    /**
     * Set organizationhow1
     *
     * @param string $organizationhow1
     *
     * @return Cdp
     */
    public function setOrganizationhow1($organizationhow1)
    {
        $this->organizationhow1 = $organizationhow1;

        return $this;
    }

    /**
     * Get organizationhow1
     *
     * @return string
     */
    public function getOrganizationhow1()
    {
        return $this->organizationhow1;
    }

    /**
     * Set organizationhow2
     *
     * @param string $organizationhow2
     *
     * @return Cdp
     */
    public function setOrganizationhow2($organizationhow2)
    {
        $this->organizationhow2 = $organizationhow2;

        return $this;
    }

    /**
     * Get organizationhow2
     *
     * @return string
     */
    public function getOrganizationhow2()
    {
        return $this->organizationhow2;
    }

    /**
     * Set organizationhow3
     *
     * @param string $organizationhow3
     *
     * @return Cdp
     */
    public function setOrganizationhow3($organizationhow3)
    {
        $this->organizationhow3 = $organizationhow3;

        return $this;
    }

    /**
     * Get organizationhow3
     *
     * @return string
     */
    public function getOrganizationhow3()
    {
        return $this->organizationhow3;
    }

    /**
     * Set organizationhow4
     *
     * @param string $organizationhow4
     *
     * @return Cdp
     */
    public function setOrganizationhow4($organizationhow4)
    {
        $this->organizationhow4 = $organizationhow4;

        return $this;
    }

    /**
     * Get organizationhow4
     *
     * @return string
     */
    public function getOrganizationhow4()
    {
        return $this->organizationhow4;
    }

    /**
     * Set organizationhow5
     *
     * @param string $organizationhow5
     *
     * @return Cdp
     */
    public function setOrganizationhow5($organizationhow5)
    {
        $this->organizationhow5 = $organizationhow5;

        return $this;
    }

    /**
     * Get organizationhow5
     *
     * @return string
     */
    public function getOrganizationhow5()
    {
        return $this->organizationhow5;
    }

    /**
     * Set organizationsuccess1
     *
     * @param string $organizationsuccess1
     *
     * @return Cdp
     */
    public function setOrganizationsuccess1($organizationsuccess1)
    {
        $this->organizationsuccess1 = $organizationsuccess1;

        return $this;
    }

    /**
     * Get organizationsuccess1
     *
     * @return string
     */
    public function getOrganizationsuccess1()
    {
        return $this->organizationsuccess1;
    }

    /**
     * Set organizationsuccess2
     *
     * @param string $organizationsuccess2
     *
     * @return Cdp
     */
    public function setOrganizationsuccess2($organizationsuccess2)
    {
        $this->organizationsuccess2 = $organizationsuccess2;

        return $this;
    }

    /**
     * Get organizationsuccess2
     *
     * @return string
     */
    public function getOrganizationsuccess2()
    {
        return $this->organizationsuccess2;
    }

    /**
     * Set organizationsuccess3
     *
     * @param string $organizationsuccess3
     *
     * @return Cdp
     */
    public function setOrganizationsuccess3($organizationsuccess3)
    {
        $this->organizationsuccess3 = $organizationsuccess3;

        return $this;
    }

    /**
     * Get organizationsuccess3
     *
     * @return string
     */
    public function getOrganizationsuccess3()
    {
        return $this->organizationsuccess3;
    }

    /**
     * Set organizationsuccess4
     *
     * @param string $organizationsuccess4
     *
     * @return Cdp
     */
    public function setOrganizationsuccess4($organizationsuccess4)
    {
        $this->organizationsuccess4 = $organizationsuccess4;

        return $this;
    }

    /**
     * Get organizationsuccess4
     *
     * @return string
     */
    public function getOrganizationsuccess4()
    {
        return $this->organizationsuccess4;
    }

    /**
     * Set organizationsuccess5
     *
     * @param string $organizationsuccess5
     *
     * @return Cdp
     */
    public function setOrganizationsuccess5($organizationsuccess5)
    {
        $this->organizationsuccess5 = $organizationsuccess5;

        return $this;
    }

    /**
     * Get organizationsuccess5
     *
     * @return string
     */
    public function getOrganizationsuccess5()
    {
        return $this->organizationsuccess5;
    }

    /**
     * Set organizationneeds1
     *
     * @param string $organizationneeds1
     *
     * @return Cdp
     */
    public function setOrganizationneeds1($organizationneeds1)
    {
        $this->organizationneeds1 = $organizationneeds1;

        return $this;
    }

    /**
     * Get organizationneeds1
     *
     * @return string
     */
    public function getOrganizationneeds1()
    {
        return $this->organizationneeds1;
    }

    /**
     * Set organizationneeds2
     *
     * @param string $organizationneeds2
     *
     * @return Cdp
     */
    public function setOrganizationneeds2($organizationneeds2)
    {
        $this->organizationneeds2 = $organizationneeds2;

        return $this;
    }

    /**
     * Get organizationneeds2
     *
     * @return string
     */
    public function getOrganizationneeds2()
    {
        return $this->organizationneeds2;
    }

    /**
     * Set organizationneeds3
     *
     * @param string $organizationneeds3
     *
     * @return Cdp
     */
    public function setOrganizationneeds3($organizationneeds3)
    {
        $this->organizationneeds3 = $organizationneeds3;

        return $this;
    }

    /**
     * Get organizationneeds3
     *
     * @return string
     */
    public function getOrganizationneeds3()
    {
        return $this->organizationneeds3;
    }

    /**
     * Set organizationneeds4
     *
     * @param string $organizationneeds4
     *
     * @return Cdp
     */
    public function setOrganizationneeds4($organizationneeds4)
    {
        $this->organizationneeds4 = $organizationneeds4;

        return $this;
    }

    /**
     * Get organizationneeds4
     *
     * @return string
     */
    public function getOrganizationneeds4()
    {
        return $this->organizationneeds4;
    }

    /**
     * Set organizationneeds5
     *
     * @param string $organizationneeds5
     *
     * @return Cdp
     */
    public function setOrganizationneeds5($organizationneeds5)
    {
        $this->organizationneeds5 = $organizationneeds5;

        return $this;
    }

    /**
     * Get organizationneeds5
     *
     * @return string
     */
    public function getOrganizationneeds5()
    {
        return $this->organizationneeds5;
    }

    /**
     * Set careerobjective
     *
     * @param string $careerobjective
     *
     * @return Cdp
     */
    public function setCareerobjective($careerobjective)
    {
        $this->careerobjective = $careerobjective;

        return $this;
    }

    /**
     * Get careerobjective
     *
     * @return string
     */
    public function getCareerobjective()
    {
        return $this->careerobjective;
    }

    /**
     * Set additionalinformation
     *
     * @param string $additionalinformation
     *
     * @return Cdp
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
     * Set feedbackcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycle
     *
     * @return Cdp
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
     * Set formstatus
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Formstatus $formstatus
     *
     * @return Cdp
     */
    public function setFormstatus(\IntoPeople\DatabaseBundle\Entity\Formstatus $formstatus = null)
    {
        $this->formstatus = $formstatus;      
        
        $history = new Cdphistory();
        $history->setCdp($this);
        $history->setFormstatus($formstatus);
        
        $dt = new \DateTime();
        
        $history->setDate($dt);
        
        $this->addCdphistory($history);

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
     * Set supervisor
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $supervisor
     *
     * @return Cdp
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
     * Set cdptemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplate
     *
     * @return Cdp
     */
    public function setCdptemplate(\IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplate = null)
    {
        $this->cdptemplate = $cdptemplate;

        return $this;
    }

    /**
     * Get cdptemplate
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Cdptemplate
     */
    public function getCdptemplate()
    {
        return $this->cdptemplate;
    }

    /**
     * Set developmentneeds
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Developmentneeds $developmentneeds
     *
     * @return Cdp
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
     * Add developmentneeds
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Developmentneeds $developmentneeds
     * @return Cdp
     */
    public function addDevelopmentneeds(\IntoPeople\DatabaseBundle\Entity\Developmentneeds $developmentneeds)
    {
        $this->developmentneeds[] = $developmentneeds;
    
        $developmentneeds->setCdp($this);
       
        return $this;
    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cdphistories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cdphistory
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdphistory $cdphistory
     *
     * @return Cdp
     */
    public function addCdphistory(\IntoPeople\DatabaseBundle\Entity\Cdphistory $cdphistory)
    {
        $this->cdphistories[] = $cdphistory;

        return $this;
    }

    /**
     * Remove cdphistory
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdphistory $cdphistory
     */
    public function removeCdphistory(\IntoPeople\DatabaseBundle\Entity\Cdphistory $cdphistory)
    {
        $this->cdphistories->removeElement($cdphistory);
    }

    /**
     * Get cdphistories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdphistories()
    {
        return $this->cdphistories;
    }

    /**
     * Set corequality1
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Corequality $corequality1
     * @return Cdp
     */
    public function setCorequality1(\IntoPeople\DatabaseBundle\Entity\Corequality $corequality1 = null)
    {
        $this->corequality1 = $corequality1;

        return $this;
    }

    /**
     * Get corequality1
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Corequality 
     */
    public function getCorequality1()
    {
        return $this->corequality1;
    }

    /**
     * Set corequality2
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Corequality $corequality2
     * @return Cdp
     */
    public function setCorequality2(\IntoPeople\DatabaseBundle\Entity\Corequality $corequality2 = null)
    {
        $this->corequality2 = $corequality2;

        return $this;
    }

    /**
     * Get corequality2
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Corequality 
     */
    public function getCorequality2()
    {
        return $this->corequality2;
    }

    /**
     * Set corequality3
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Corequality $corequality3
     * @return Cdp
     */
    public function setCorequality3(\IntoPeople\DatabaseBundle\Entity\Corequality $corequality3 = null)
    {
        $this->corequality3 = $corequality3;

        return $this;
    }

    /**
     * Get corequality3
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Corequality 
     */
    public function getCorequality3()
    {
        return $this->corequality3;
    }

    /**
     * Set corequality4
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Corequality $corequality4
     * @return Cdp
     */
    public function setCorequality4(\IntoPeople\DatabaseBundle\Entity\Corequality $corequality4 = null)
    {
        $this->corequality4 = $corequality4;

        return $this;
    }

    /**
     * Get corequality4
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Corequality 
     */
    public function getCorequality4()
    {
        return $this->corequality4;
    }

    /**
     * Set corequality5
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Corequality $corequality5
     * @return Cdp
     */
    public function setCorequality5(\IntoPeople\DatabaseBundle\Entity\Corequality $corequality5 = null)
    {
        $this->corequality5 = $corequality5;

        return $this;
    }

    /**
     * Get corequality5
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Corequality 
     */
    public function getCorequality5()
    {
        return $this->corequality5;
    }
}
