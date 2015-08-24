<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Endyearhistory
 *
 * @ORM\Table(name="EndyearHistory", indexes={@ORM\Index(name="FormStatusId", columns={"FormStatusId"}), @ORM\Index(name="Endyear", columns={"EndyearId"})})
 * @ORM\Entity
 */
class Endyearhistory
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
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Formstatus", inversedBy="cdphistories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FormstatusId", referencedColumnName="Id")
     * })
     */
    private $formstatus;
    
    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Endyear
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Endyear", inversedBy="endyearhistories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EndyearId", referencedColumnName="Id")
     * })
     */
    private $endyear;
  
    


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Endyearhistory
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
     * @return Endyearhistory
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
     * Set endyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyear
     *
     * @return Endyearhistory
     */
    public function setEndyear(\IntoPeople\DatabaseBundle\Entity\Endyear $endyear = null)
    {
        $this->endyear = $endyear;

        return $this;
    }

    /**
     * Get endyear
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Endyear
     */
    public function getEndyear()
    {
        return $this->endyear;
    }
}
