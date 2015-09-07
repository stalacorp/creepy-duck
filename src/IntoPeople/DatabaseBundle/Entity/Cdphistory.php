<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cdphistory
 *
 * @ORM\Table(name="CDPHistory", indexes={@ORM\Index(name="FormStatusId", columns={"FormStatusId"}), @ORM\Index(name="CDP", columns={"CDPId"})})
 * @ORM\Entity
 */
class Cdphistory
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=true)
     */
    private $date;

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
     * @var \IntoPeople\DatabaseBundle\Entity\Cdp
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", inversedBy="cdphistories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CDPId", referencedColumnName="Id")
     * })
     */
    private $cdp;

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Cdphistory
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
     * @return Cdphistory
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
     * Set cdp
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdp
     *
     * @return Cdphistory
     */
    public function setCdp(\IntoPeople\DatabaseBundle\Entity\Cdp $cdp = null)
    {
        $this->cdp = $cdp;

        return $this;
    }

    /**
     * Get cdp
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Cdp
     */
    public function getCdp()
    {
        return $this->cdp;
    }
}
