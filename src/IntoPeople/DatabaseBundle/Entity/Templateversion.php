<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Templateversion
 *
 * @ORM\Table(name="TemplateVersion")
 * @ORM\Entity
 */
class Templateversion
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
     * @var string
     *
     * @ORM\Column(name="Version", type="string", length=250, nullable=false)
     */
    private $version;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="templateversion")
     */
    protected $cdps;

    public function __construct1()
    {
        $this->cdps = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Midyear", cascade={"persist"}, mappedBy="templateversion")
     */
    protected $midyears;

    public function __construct2()
    {
        $this->midyears = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Endyear", cascade={"persist"}, mappedBy="templateversion")
     */
    protected $endyears;

    public function __construct3()
    {
        $this->endyears = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdptemplate", cascade={"persist"}, mappedBy="templateversion")
     */
    protected $cdptemplates;

    public function __construct4()
    {
        $this->cdptemplates = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Midyeartemplate", cascade={"persist"}, mappedBy="templateversion")
     */
    protected $midyeartemplates;

    public function __construct5()
    {
        $this->midyeartemplates = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Endyeartemplate", cascade={"persist"}, mappedBy="templateversion")
     */
    protected $endyeartemplates;

    public function __construct6()
    {
        $this->endyeartemplates = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getVersion();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cdps = new \Doctrine\Common\Collections\ArrayCollection();
        $this->midyears = new \Doctrine\Common\Collections\ArrayCollection();
        $this->endyears = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cdptemplates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->midyeartemplates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->endyeartemplates = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set version
     *
     * @param string $version
     * @return Templateversion
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Templateversion
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
     * Add cdps
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdps
     * @return Templateversion
     */
    public function addCdp(\IntoPeople\DatabaseBundle\Entity\Cdp $cdps)
    {
        $this->cdps[] = $cdps;

        return $this;
    }

    /**
     * Remove cdps
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdps
     */
    public function removeCdp(\IntoPeople\DatabaseBundle\Entity\Cdp $cdps)
    {
        $this->cdps->removeElement($cdps);
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
     * Add midyears
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyears
     * @return Templateversion
     */
    public function addMidyear(\IntoPeople\DatabaseBundle\Entity\Midyear $midyears)
    {
        $this->midyears[] = $midyears;

        return $this;
    }

    /**
     * Remove midyears
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyears
     */
    public function removeMidyear(\IntoPeople\DatabaseBundle\Entity\Midyear $midyears)
    {
        $this->midyears->removeElement($midyears);
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
     * Add endyears
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyears
     * @return Templateversion
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
     * Add cdptemplates
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplates
     * @return Templateversion
     */
    public function addCdptemplate(\IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplates)
    {
        $this->cdptemplates[] = $cdptemplates;

        return $this;
    }

    /**
     * Remove cdptemplates
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplates
     */
    public function removeCdptemplate(\IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplates)
    {
        $this->cdptemplates->removeElement($cdptemplates);
    }

    /**
     * Get cdptemplates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCdptemplates()
    {
        return $this->cdptemplates;
    }

    /**
     * Add midyeartemplates
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyeartemplate $midyeartemplates
     * @return Templateversion
     */
    public function addMidyeartemplate(\IntoPeople\DatabaseBundle\Entity\Midyeartemplate $midyeartemplates)
    {
        $this->midyeartemplates[] = $midyeartemplates;

        return $this;
    }

    /**
     * Remove midyeartemplates
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyeartemplate $midyeartemplates
     */
    public function removeMidyeartemplate(\IntoPeople\DatabaseBundle\Entity\Midyeartemplate $midyeartemplates)
    {
        $this->midyeartemplates->removeElement($midyeartemplates);
    }

    /**
     * Get midyeartemplates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMidyeartemplates()
    {
        return $this->midyeartemplates;
    }

    /**
     * Add endyeartemplates
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyeartemplate $endyeartemplates
     * @return Templateversion
     */
    public function addEndyeartemplate(\IntoPeople\DatabaseBundle\Entity\Endyeartemplate $endyeartemplates)
    {
        $this->endyeartemplates[] = $endyeartemplates;

        return $this;
    }

    /**
     * Remove endyeartemplates
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyeartemplate $endyeartemplates
     */
    public function removeEndyeartemplate(\IntoPeople\DatabaseBundle\Entity\Endyeartemplate $endyeartemplates)
    {
        $this->endyeartemplates->removeElement($endyeartemplates);
    }

    /**
     * Get endyeartemplates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEndyeartemplates()
    {
        return $this->endyeartemplates;
    }
}
