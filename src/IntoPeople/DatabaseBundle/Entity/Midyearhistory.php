<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Midyearhistory
 *
 * @ORM\Table(name="MidyearHistory", indexes={@ORM\Index(name="FormStatusId", columns={"FormStatusId"}), @ORM\Index(name="Midyear", columns={"MidyearId"})})
 * @ORM\Entity
 */
class Midyearhistory
{
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Formstatus
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Formstatus", cascade={"persist"}, inversedBy="cdphistories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FormstatusId", referencedColumnName="Id")
     * })
     */
    private $formstatus;
    
    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Midyear
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Midyear", cascade={"persist"}, inversedBy="midyearhistories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MidyearId", referencedColumnName="Id")
     * })
     */
    private $midyear;
  
    


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Midyearhistory
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set formstatus
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Formstatus $formstatus
     *
     * @return Midyearhistory
     */
    public function setFormstatus(\IntoPeople\DatabaseBundle\Entity\Formstatus $formstatus = null)
    {
        $this->formstatus = $formstatus;

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
     * Set midyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyear
     *
     * @return Midyearhistory
     */
    public function setMidyear(\IntoPeople\DatabaseBundle\Entity\Midyear $midyear = null)
    {
        $this->midyear = $midyear;

        return $this;
    }

    /**
     * Get midyear
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Midyear
     */
    public function getMidyear()
    {
        return $this->midyear;
    }
}
