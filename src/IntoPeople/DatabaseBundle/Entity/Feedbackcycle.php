<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Feedbackcycle
 *
 * 
 * @ORM\Table(name="FeedbackCycle", indexes={@ORM\Index(name="GeneralCycleId", columns={"GeneralCycleId"}), @ORM\Index(name="CycleStatusId", columns={"CycleStatusId"}), @ORM\Index(name="CDPId", columns={"CDPId"}), @ORM\Index(name="MidYearId", columns={"MidYearId"}), @ORM\Index(name="EndYearId", columns={"EndYearId"}), @ORM\Index(name="UserId", columns={"UserId"})})
 * @ORM\Entity(repositoryClass="IntoPeople\DatabaseBundle\Entity\FeedbackcycleRepository")
 */
class Feedbackcycle
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
     * @var \IntoPeople\DatabaseBundle\Entity\Midyear
     *
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Midyear", cascade={"persist"}, inversedBy="feedbackcycle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MidYearId", referencedColumnName="Id")
     * })
     */
    private $midyear;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Endyear
     *
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Endyear", cascade={"persist"}, inversedBy="feedbackcycle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EndYearId", referencedColumnName="Id")
     * })
     */
    private $endyear;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Cdp
     *
     * @ORM\OneToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, inversedBy="feedbackcycle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CDPId", referencedColumnName="Id")
     * })
     */
    private $cdp;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Cyclestatus
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Cyclestatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CycleStatusId", referencedColumnName="Id")
     * })
     */
    private $cyclestatus;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Generalcycle
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Generalcycle", inversedBy="feedbackcycles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GeneralCycleId", referencedColumnName="Id")
     * })
     */
    private $generalcycle;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\User", inversedBy="feedbackcycles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UserId", referencedColumnName="Id")
     * })
     */
    private $user;


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
     * Set midyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyear
     * @return Feedbackcycle
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

    /**
     * Set endyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyear
     * @return Feedbackcycle
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

    /**
     * Set cdp
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdp
     * @return Feedbackcycle
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

    /**
     * Set cyclestatus
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cyclestatus $cyclestatus
     * @return Feedbackcycle
     */
    public function setCyclestatus(\IntoPeople\DatabaseBundle\Entity\Cyclestatus $cyclestatus = null)
    {
        $this->cyclestatus = $cyclestatus;

        return $this;
    }

    /**
     * Get cyclestatus
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Cyclestatus 
     */
    public function getCyclestatus()
    {
        return $this->cyclestatus;
    }

    /**
     * Set generalcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle
     * @return Feedbackcycle
     */
    public function setGeneralcycle(\IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle = null)
    {
        $this->generalcycle = $generalcycle;

        return $this;
    }

    /**
     * Get generalcycle
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Generalcycle 
     */
    public function getGeneralcycle()
    {
        return $this->generalcycle;
    }

    /**
     * Set user
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $user
     * @return Feedbackcycle
     */
    public function setUser(\IntoPeople\DatabaseBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \IntoPeople\DatabaseBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
