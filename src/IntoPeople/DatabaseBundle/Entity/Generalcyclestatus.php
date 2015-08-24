<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Generalcyclestatus
 *
 * @ORM\Table(name="GeneralCycleStatus")
 * @ORM\Entity
 */
class Generalcyclestatus
{
    /**
     * @ORM\OneToMany(targetEntity="Generalcycle", mappedBy="generalcyclestatus")
     */
    protected $generalcycles;
    
    public function __construct()
    {
        $this->generalcycles = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getName();
    }
    
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Generalcyclestatus
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
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Add generalcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle
     *
     * @return Generalcyclestatus
     */
    public function addGeneralcycle(\IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle)
    {
        $this->generalcycles[] = $generalcycle;

        return $this;
    }

    /**
     * Remove generalcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle
     */
    public function removeGeneralcycle(\IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle)
    {
        $this->generalcycles->removeElement($generalcycle);
    }

    /**
     * Get generalcycles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGeneralcycles()
    {
        return $this->generalcycles;
    }
}
