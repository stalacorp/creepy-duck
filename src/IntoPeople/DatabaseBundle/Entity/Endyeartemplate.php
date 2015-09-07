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
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Endyear", mappedBy="endyeartemplate")
     */
    protected $endyears;
    
    public function __construct()
    {
        $this->endyears = new ArrayCollection();
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;

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
     * @var string
     *
     * @ORM\Column(name="MainTitle", type="string", length=250, nullable=true)
     */
    private $mainTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="Title1", type="string", length=250, nullable=true)
     */
    private $title1;

    /**
     * @var string
     *
     * @ORM\Column(name="Title2", type="string", length=250, nullable=true)
     */
    private $title2;

    /**
     * @var string
     *
     * @ORM\Column(name="Title3", type="string", length=250, nullable=true)
     */
    private $title3;

    /**
     * @var string
     *
     * @ORM\Column(name="Title4", type="string", length=250, nullable=true)
     */
    private $title4;

    /**
     * @var string
     *
     * @ORM\Column(name="Title1Description", type="text", length=65535, nullable=true)
     */
    private $title1Description;

    /**
     * @var string
     *
     * @ORM\Column(name="Title2Description", type="text", length=65535, nullable=true)
     */
    private $title2Description;

    /**
     * @var string
     *
     * @ORM\Column(name="Title3Description", type="text", length=65535, nullable=true)
     */
    private $title3Description;

    # Personalia #


    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=250, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Supervisor", type="string", length=250, nullable=true)
     */
    private $supervisor;

    /**
     * @var string
     *
     * @ORM\Column(name="DateDiscussion", type="string", length=250, nullable=true)
     */
    private $dateDiscussion;

    /**
     * @var string
     *
     * @ORM\Column(name="Team", type="string", length=250, nullable=true)
     */
    private $team;

    /**
     * @var string
     *
     * @ORM\Column(name="Function", type="string", length=250, nullable=true)
     */
    private $function;


    #table2#


    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col1", type="string", length=250, nullable=true)
     */
    private $table2Col1;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col2", type="string", length=250, nullable=true)
     */
    private $table2Col2;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col3", type="string", length=250, nullable=true)
     */
    private $table2Col3;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col4", type="string", length=250, nullable=true)
     */
    private $table2Col4;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col5", type="string", length=250, nullable=true)
     */
    private $table2Col5;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col1Descr", type="text", length=65535, nullable=true)
     */
    private $table2Col1Descr;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col2Descr", type="text", length=65535, nullable=true)
     */
    private $table2Col2Descr;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col3Descr", type="text", length=65535, nullable=true)
     */
    private $table2Col3Descr;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col4Descr", type="text", length=65535, nullable=true)
     */
    private $table2Col4Descr;

    /**
     * @var string
     *
     * @ORM\Column(name="Table2Col5Descr", type="text", length=65535, nullable=true)
     */
    private $table2Col5Descr;


    # Table3 #


    /**
     * @var string
     *
     * @ORM\Column(name="Table3Col1", type="string", length=250, nullable=true)
     */
    private $table3Col1;

    /**
     * @var string
     *
     * @ORM\Column(name="Table3Col2", type="string", length=250, nullable=true)
     */
    private $table3Col2;

    /**
     * @var string
     *
     * @ORM\Column(name="Table3Col1Descr", type="text", length=65535, nullable=true)
     */
    private $table3Col1Descr;

    /**
     * @var string
     *
     * @ORM\Column(name="Table3Col2Descr", type="text", length=65535, nullable=true)
     */
    private $table3Col2Descr;

    /**
     * @var string
     *
     * @ORM\Column(name="Table3Title1", type="string", length=250, nullable=true)
     */
    private $table3Title1;

    /**
     * @var string
     *
     * @ORM\Column(name="Table3Title2", type="string", length=250, nullable=true)
     */
    private $table3Title2;

    /**
     * @var string
     *
     * @ORM\Column(name="Table3Title3", type="string", length=250, nullable=true)
     */
    private $table3Title3;

    /**
     * @var string
     *
     * @ORM\Column(name="Question1", type="text", length=65535, nullable=true)
     */
    private $question1;

    /**
     * @var string
     *
     * @ORM\Column(name="Question2", type="text", length=65535, nullable=true)
     */
    private $question2;

    /**
     * @var string
     *
     * @ORM\Column(name="Question3", type="text", length=65535, nullable=true)
     */
    private $question3;

    /**
     * @var string
     *
     * @ORM\Column(name="Question4", type="text", length=65535, nullable=true)
     */
    private $question4;

    /**
     * @var string
     *
     * @ORM\Column(name="SupervisorComment", type="string", length=250, nullable=true)
     */
    private $supervisorComment;

    /**
     * @var string
     *
     * @ORM\Column(name="Feedback", type="string", length=250, nullable=true)
     */
    private $feedback;

    /**
     * @var string
     *
     * @ORM\Column(name="SignatureSupervisor", type="string", length=250, nullable=true)
     */
    private $signatureSupervisor;

    /**
     * @var string
     *
     * @ORM\Column(name="SignatureEmployee", type="string", length=250, nullable=true)
     */
    private $signatureEmployee;


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
     * Set date
     *
     * @param \DateTime $date
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
     * Set mainTitle
     *
     * @param string $mainTitle
     * @return Endyeartemplate
     */
    public function setMainTitle($mainTitle)
    {
        $this->mainTitle = $mainTitle;

        return $this;
    }

    /**
     * Get mainTitle
     *
     * @return string 
     */
    public function getMainTitle()
    {
        return $this->mainTitle;
    }

    /**
     * Set title1
     *
     * @param string $title1
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * Set title1Description
     *
     * @param string $title1Description
     * @return Endyeartemplate
     */
    public function setTitle1Description($title1Description)
    {
        $this->title1Description = $title1Description;

        return $this;
    }

    /**
     * Get title1Description
     *
     * @return string 
     */
    public function getTitle1Description()
    {
        return $this->title1Description;
    }

    /**
     * Set title2Description
     *
     * @param string $title2Description
     * @return Endyeartemplate
     */
    public function setTitle2Description($title2Description)
    {
        $this->title2Description = $title2Description;

        return $this;
    }

    /**
     * Get title2Description
     *
     * @return string 
     */
    public function getTitle2Description()
    {
        return $this->title2Description;
    }

    /**
     * Set title3Description
     *
     * @param string $title3Description
     * @return Endyeartemplate
     */
    public function setTitle3Description($title3Description)
    {
        $this->title3Description = $title3Description;

        return $this;
    }

    /**
     * Get title3Description
     *
     * @return string 
     */
    public function getTitle3Description()
    {
        return $this->title3Description;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Endyeartemplate
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set supervisor
     *
     * @param string $supervisor
     * @return Endyeartemplate
     */
    public function setSupervisor($supervisor)
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    /**
     * Get supervisor
     *
     * @return string 
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Set dateDiscussion
     *
     * @param string $dateDiscussion
     * @return Endyeartemplate
     */
    public function setDateDiscussion($dateDiscussion)
    {
        $this->dateDiscussion = $dateDiscussion;

        return $this;
    }

    /**
     * Get dateDiscussion
     *
     * @return string 
     */
    public function getDateDiscussion()
    {
        return $this->dateDiscussion;
    }

    /**
     * Set team
     *
     * @param string $team
     * @return Endyeartemplate
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return string 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set function
     *
     * @param string $function
     * @return Endyeartemplate
     */
    public function setFunction($function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return string 
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set table2Col1
     *
     * @param string $table2Col1
     * @return Endyeartemplate
     */
    public function setTable2Col1($table2Col1)
    {
        $this->table2Col1 = $table2Col1;

        return $this;
    }

    /**
     * Get table2Col1
     *
     * @return string 
     */
    public function getTable2Col1()
    {
        return $this->table2Col1;
    }

    /**
     * Set table2Col2
     *
     * @param string $table2Col2
     * @return Endyeartemplate
     */
    public function setTable2Col2($table2Col2)
    {
        $this->table2Col2 = $table2Col2;

        return $this;
    }

    /**
     * Get table2Col2
     *
     * @return string 
     */
    public function getTable2Col2()
    {
        return $this->table2Col2;
    }

    /**
     * Set table2Col3
     *
     * @param string $table2Col3
     * @return Endyeartemplate
     */
    public function setTable2Col3($table2Col3)
    {
        $this->table2Col3 = $table2Col3;

        return $this;
    }

    /**
     * Get table2Col3
     *
     * @return string 
     */
    public function getTable2Col3()
    {
        return $this->table2Col3;
    }

    /**
     * Set table2Col4
     *
     * @param string $table2Col4
     * @return Endyeartemplate
     */
    public function setTable2Col4($table2Col4)
    {
        $this->table2Col4 = $table2Col4;

        return $this;
    }

    /**
     * Get table2Col4
     *
     * @return string 
     */
    public function getTable2Col4()
    {
        return $this->table2Col4;
    }

    /**
     * Set table2Col5
     *
     * @param string $table2Col5
     * @return Endyeartemplate
     */
    public function setTable2Col5($table2Col5)
    {
        $this->table2Col5 = $table2Col5;

        return $this;
    }

    /**
     * Get table2Col5
     *
     * @return string 
     */
    public function getTable2Col5()
    {
        return $this->table2Col5;
    }

    /**
     * Set table2Col1Descr
     *
     * @param string $table2Col1Descr
     * @return Endyeartemplate
     */
    public function setTable2Col1Descr($table2Col1Descr)
    {
        $this->table2Col1Descr = $table2Col1Descr;

        return $this;
    }

    /**
     * Get table2Col1Descr
     *
     * @return string 
     */
    public function getTable2Col1Descr()
    {
        return $this->table2Col1Descr;
    }

    /**
     * Set table2Col2Descr
     *
     * @param string $table2Col2Descr
     * @return Endyeartemplate
     */
    public function setTable2Col2Descr($table2Col2Descr)
    {
        $this->table2Col2Descr = $table2Col2Descr;

        return $this;
    }

    /**
     * Get table2Col2Descr
     *
     * @return string 
     */
    public function getTable2Col2Descr()
    {
        return $this->table2Col2Descr;
    }

    /**
     * Set table2Col3Descr
     *
     * @param string $table2Col3Descr
     * @return Endyeartemplate
     */
    public function setTable2Col3Descr($table2Col3Descr)
    {
        $this->table2Col3Descr = $table2Col3Descr;

        return $this;
    }

    /**
     * Get table2Col3Descr
     *
     * @return string 
     */
    public function getTable2Col3Descr()
    {
        return $this->table2Col3Descr;
    }

    /**
     * Set table2Col4Descr
     *
     * @param string $table2Col4Descr
     * @return Endyeartemplate
     */
    public function setTable2Col4Descr($table2Col4Descr)
    {
        $this->table2Col4Descr = $table2Col4Descr;

        return $this;
    }

    /**
     * Get table2Col4Descr
     *
     * @return string 
     */
    public function getTable2Col4Descr()
    {
        return $this->table2Col4Descr;
    }

    /**
     * Set table2Col5Descr
     *
     * @param string $table2Col5Descr
     * @return Endyeartemplate
     */
    public function setTable2Col5Descr($table2Col5Descr)
    {
        $this->table2Col5Descr = $table2Col5Descr;

        return $this;
    }

    /**
     * Get table2Col5Descr
     *
     * @return string 
     */
    public function getTable2Col5Descr()
    {
        return $this->table2Col5Descr;
    }

    /**
     * Set table3Col1
     *
     * @param string $table3Col1
     * @return Endyeartemplate
     */
    public function setTable3Col1($table3Col1)
    {
        $this->table3Col1 = $table3Col1;

        return $this;
    }

    /**
     * Get table3Col1
     *
     * @return string 
     */
    public function getTable3Col1()
    {
        return $this->table3Col1;
    }

    /**
     * Set table3Col2
     *
     * @param string $table3Col2
     * @return Endyeartemplate
     */
    public function setTable3Col2($table3Col2)
    {
        $this->table3Col2 = $table3Col2;

        return $this;
    }

    /**
     * Get table3Col2
     *
     * @return string 
     */
    public function getTable3Col2()
    {
        return $this->table3Col2;
    }

    /**
     * Set table3Col1Descr
     *
     * @param string $table3Col1Descr
     * @return Endyeartemplate
     */
    public function setTable3Col1Descr($table3Col1Descr)
    {
        $this->table3Col1Descr = $table3Col1Descr;

        return $this;
    }

    /**
     * Get table3Col1Descr
     *
     * @return string 
     */
    public function getTable3Col1Descr()
    {
        return $this->table3Col1Descr;
    }

    /**
     * Set table3Col2Descr
     *
     * @param string $table3Col2Descr
     * @return Endyeartemplate
     */
    public function setTable3Col2Descr($table3Col2Descr)
    {
        $this->table3Col2Descr = $table3Col2Descr;

        return $this;
    }

    /**
     * Get table3Col2Descr
     *
     * @return string 
     */
    public function getTable3Col2Descr()
    {
        return $this->table3Col2Descr;
    }

    /**
     * Set table3Title1
     *
     * @param string $table3Title1
     * @return Endyeartemplate
     */
    public function setTable3Title1($table3Title1)
    {
        $this->table3Title1 = $table3Title1;

        return $this;
    }

    /**
     * Get table3Title1
     *
     * @return string 
     */
    public function getTable3Title1()
    {
        return $this->table3Title1;
    }

    /**
     * Set table3Title2
     *
     * @param string $table3Title2
     * @return Endyeartemplate
     */
    public function setTable3Title2($table3Title2)
    {
        $this->table3Title2 = $table3Title2;

        return $this;
    }

    /**
     * Get table3Title2
     *
     * @return string 
     */
    public function getTable3Title2()
    {
        return $this->table3Title2;
    }

    /**
     * Set table3Title3
     *
     * @param string $table3Title3
     * @return Endyeartemplate
     */
    public function setTable3Title3($table3Title3)
    {
        $this->table3Title3 = $table3Title3;

        return $this;
    }

    /**
     * Get table3Title3
     *
     * @return string 
     */
    public function getTable3Title3()
    {
        return $this->table3Title3;
    }

    /**
     * Set question1
     *
     * @param string $question1
     * @return Endyeartemplate
     */
    public function setQuestion1($question1)
    {
        $this->question1 = $question1;

        return $this;
    }

    /**
     * Get question1
     *
     * @return string 
     */
    public function getQuestion1()
    {
        return $this->question1;
    }

    /**
     * Set question2
     *
     * @param string $question2
     * @return Endyeartemplate
     */
    public function setQuestion2($question2)
    {
        $this->question2 = $question2;

        return $this;
    }

    /**
     * Get question2
     *
     * @return string 
     */
    public function getQuestion2()
    {
        return $this->question2;
    }

    /**
     * Set question3
     *
     * @param string $question3
     * @return Endyeartemplate
     */
    public function setQuestion3($question3)
    {
        $this->question3 = $question3;

        return $this;
    }

    /**
     * Get question3
     *
     * @return string 
     */
    public function getQuestion3()
    {
        return $this->question3;
    }

    /**
     * Set question4
     *
     * @param string $question4
     * @return Endyeartemplate
     */
    public function setQuestion4($question4)
    {
        $this->question4 = $question4;

        return $this;
    }

    /**
     * Get question4
     *
     * @return string 
     */
    public function getQuestion4()
    {
        return $this->question4;
    }

    /**
     * Set supervisorComment
     *
     * @param string $supervisorComment
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * @return Endyeartemplate
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
     * Add endyears
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyears
     * @return Endyeartemplate
     */
    public function addEndyear(\IntoPeople\DatabaseBundle\Entity\Endyear $endyears)
    {
        $this->endyears[] = $endyears;

        return $this;
    }

    /**
     * Remove endyears
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyears
     */
    public function removeEndyear(\IntoPeople\DatabaseBundle\Entity\Endyear $endyears)
    {
        $this->endyears->removeElement($endyears);
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
     * Set language
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Language $language
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

    /**
     * Set organization
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Organization $organization
     * @return Endyeartemplate
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
}
