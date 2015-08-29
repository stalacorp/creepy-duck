<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use IntoPeople\DatabaseBundle\Validator\Constraints as IntoPeopleAssert;

/**
 * Generalcycle
 *
 * @ORM\Table(name="GeneralCycle", indexes={@ORM\Index(name="OrganizationId", columns={"OrganizationId"}), @ORM\Index(name="GeneralcyclestatusId", columns={"GeneralcyclestatusId"}),})
 * @ORM\Entity(repositoryClass="IntoPeople\DatabaseBundle\Entity\GeneralcycleRepository")
 * @IntoPeopleAssert\CustomDates(message="generalcycle.startdateenddateerror")
 */
class Generalcycle
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="CdpAvailable", type="boolean", nullable=true)
     */
    private $cdpAvailable;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="MidyearAvailable", type="boolean", nullable=true)
     */
    private $midyearAvailable;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="EndyearAvailable", type="boolean", nullable=true)
     */
    private $endyearAvailable;
    
    /**
     * @var \IntoPeople\DatabaseBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\User", inversedBy="generalcycles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="startedby", referencedColumnName="Id")
     * })
     */
    private $startedby;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="StartDate", type="date", nullable=false)
     */
    private $startdate;

    /**
     * @var string
     *
     * @ORM\Column(name="Year", type="string", length=250, nullable=false)
     */
    private $year;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="StartDateCDP", type="date", nullable=true)
     */
    private $startdatecdp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EndDateCDP", type="date", nullable=true)
     */
    private $enddatecdp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="StartDateMidYear", type="date", nullable=true)
     */
    private $startdatemidyear;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EndDateMidYear", type="date", nullable=true)
     */
    private $enddatemidyear;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="StartDateYearEnd", type="date", nullable=true)
     */
    private $startdateyearend;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EndDateYearEnd", type="date", nullable=true)
     */
    private $enddateyearend;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Organization
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Organization", inversedBy="generalcycles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="OrganizationId", referencedColumnName="Id")
     * })
     */
    private $organization;
    
    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Generalcyclestatus
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Generalcyclestatus", inversedBy="generalcycles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GeneralcyclestatusId", referencedColumnName="Id")
     * })
     */
    private $generalcyclestatus;


    /**
     * @ORM\OneToMany(targetEntity="Feedbackcycle", mappedBy="generalcycle")
     */
    protected $feedbackcycles;
    
    public function __construct()
    {
        $this->feedbackcycles = new ArrayCollection();
    }
    
    /**
     * TO STRING
     */
    public function __toString()
    {
        return $this->getOrganization() . ": Generalcycle " . $this->getYear();
    }
    

    /**
     * Set startedby
     *
     * @param string $startedby
     *
     * @return Generalcycle
     */
    public function setStartedby($startedby)
    {
        $this->startedby = $startedby;

        return $this;
    }

    /**
     * Get startedby
     *
     * @return string
     */
    public function getStartedby()
    {
        return $this->startedby;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     *
     * @return Generalcycle
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set year
     *
     * @param string $year
     *
     * @return Generalcycle
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set startdatecdp
     *
     * @param \DateTime $startdatecdp
     *
     * @return Generalcycle
     */
    public function setStartdatecdp($startdatecdp)
    {
        $this->startdatecdp = $startdatecdp;

        return $this;
    }

    /**
     * Get startdatecdp
     *
     * @return \DateTime
     */
    public function getStartdatecdp()
    {
        return $this->startdatecdp;
    }

    /**
     * Set enddatecdp
     *
     * @param \DateTime $enddatecdp
     *
     * @return Generalcycle
     */
    public function setEnddatecdp($enddatecdp)
    {
        $this->enddatecdp = $enddatecdp;

        return $this;
    }

    /**
     * Get enddatecdp
     *
     * @return \DateTime
     */
    public function getEnddatecdp()
    {
        return $this->enddatecdp;
    }

    /**
     * Set startdatemidyear
     *
     * @param \DateTime $startdatemidyear
     *
     * @return Generalcycle
     */
    public function setStartdatemidyear($startdatemidyear)
    {
        $this->startdatemidyear = $startdatemidyear;

        return $this;
    }

    /**
     * Get startdatemidyear
     *
     * @return \DateTime
     */
    public function getStartdatemidyear()
    {
        return $this->startdatemidyear;
    }

    /**
     * Set enddatemidyear
     *
     * @param \DateTime $enddatemidyear
     *
     * @return Generalcycle
     */
    public function setEnddatemidyear($enddatemidyear)
    {
        $this->enddatemidyear = $enddatemidyear;

        return $this;
    }

    /**
     * Get enddatemidyear
     *
     * @return \DateTime
     */
    public function getEnddatemidyear()
    {
        return $this->enddatemidyear;
    }

    /**
     * Set startdateyearend
     *
     * @param \DateTime $startdateyearend
     *
     * @return Generalcycle
     */
    public function setStartdateyearend($startdateyearend)
    {
        $this->startdateyearend = $startdateyearend;

        return $this;
    }

    /**
     * Get startdateyearend
     *
     * @return \DateTime
     */
    public function getStartdateyearend()
    {
        return $this->startdateyearend;
    }

    /**
     * Set enddateyearend
     *
     * @param \DateTime $enddateyearend
     *
     * @return Generalcycle
     */
    public function setEnddateyearend($enddateyearend)
    {
        $this->enddateyearend = $enddateyearend;

        return $this;
    }

    /**
     * Get enddateyearend
     *
     * @return \DateTime
     */
    public function getEnddateyearend()
    {
        return $this->enddateyearend;
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
     * Add feedbackcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycle
     *
     * @return Generalcycle
     */
    public function addFeedbackcycle(\IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycle)
    {
        $this->feedbackcycles[] = $feedbackcycle;

        return $this;
    }

    /**
     * Remove feedbackcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycle
     */
    public function removeFeedbackcycle(\IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycle)
    {
        $this->feedbackcycles->removeElement($feedbackcycle);
    }

    /**
     * Get feedbackcycles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbackcycles()
    {
        return $this->feedbackcycles;
    }

    /**
     * Set organization
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Organization $organization
     *
     * @return Generalcycle
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
     * Set generalcyclestatus
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Generalcyclestatus $generalcyclestatus
     *
     * @return Generalcycle
     */
    public function setGeneralcyclestatus(\IntoPeople\DatabaseBundle\Entity\Generalcyclestatus $generalcyclestatus = null)
    {
        $this->generalcyclestatus = $generalcyclestatus;

        return $this;
    }

    /**
     * Get generalcyclestatus
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Generalcyclestatus
     */
    public function getGeneralcyclestatus()
    {
        return $this->generalcyclestatus;
    }

    /**
     * Set cdpAvailable
     *
     * @param boolean $cdpAvailable
     *
     * @return Generalcycle
     */
    public function setCdpAvailable($cdpAvailable)
    {
        $this->cdpAvailable = $cdpAvailable;

        return $this;
    }

    /**
     * Get cdpAvailable
     *
     * @return boolean
     */
    public function getCdpAvailable()
    {
        return $this->cdpAvailable;
    }

    /**
     * Set midyearAvailable
     *
     * @param boolean $midyearAvailable
     *
     * @return Generalcycle
     */
    public function setMidyearAvailable($midyearAvailable)
    {
        $this->midyearAvailable = $midyearAvailable;

        return $this;
    }

    /**
     * Get midyearAvailable
     *
     * @return boolean
     */
    public function getMidyearAvailable()
    {
        return $this->midyearAvailable;
    }

    /**
     * Set endyearAvailable
     *
     * @param boolean $endyearAvailable
     *
     * @return Generalcycle
     */
    public function setEndyearAvailable($endyearAvailable)
    {
        $this->endyearAvailable = $endyearAvailable;

        return $this;
    }

    /**
     * Get endyearAvailable
     *
     * @return boolean
     */
    public function getEndyearAvailable()
    {
        return $this->endyearAvailable;
    }

}
