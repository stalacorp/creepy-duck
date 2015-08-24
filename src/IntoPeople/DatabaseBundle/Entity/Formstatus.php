<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Formstatus
 *
 * @ORM\Table(name="FormStatus")
 * @ORM\Entity
 */
class Formstatus
{
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Cdp", mappedBy="formstatus")
     */
    protected $cdps;
    
    public function __construct1()
    {
        $this->cdps = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Midyear", mappedBy="formstatus")
     */
    protected $midyears;
    
    public function __construct2()
    {
        $this->midyears = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Endyear", mappedBy="formstatus")
     */
    protected $endyears;
    
    public function __construct3()
    {
        $this->endyears = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Cdphistory", mappedBy="formstatus")
     */
    protected $cdphistories;
    
    public function __construct4()
    {
        $this->cdphistories = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Formstatus
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set id
     *
     * @param integer $id
     */    
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Add cdp
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdp
     *
     * @return Formstatus
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
     * Add midyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyear
     *
     * @return Formstatus
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
     * Add endyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyear
     *
     * @return Formstatus
     */
    public function addEndyear(\IntoPeople\DatabaseBundle\Entity\Endyear $endyear)
    {
        $this->endyear[] = $endyear;

        return $this;
    }

    /**
     * Remove endyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyear
     */
    public function removeEndyear(\IntoPeople\DatabaseBundle\Entity\Endyear $endyear)
    {
        $this->endyear->removeElement($endyear);
    }

    /**
     * Get endyear
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEndyear()
    {
        return $this->endyear;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cdps = new \Doctrine\Common\Collections\ArrayCollection();
        $this->midyears = new \Doctrine\Common\Collections\ArrayCollection();
        $this->endyears = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add cdphistory
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdphistory $cdphistory
     *
     * @return Formstatus
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
}
