<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Corequality
 *
 * @ORM\Table(name="CoreQuality", indexes={@ORM\Index(name="LanguageId", columns={"LanguageId"})})
 * @ORM\Entity
 */
class Corequality
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
     * @ORM\Column(name="CoreQuality", type="string", length=250, nullable=false)
     */
    private $coreQuality;

    /**
     * @var string
     *
     * @ORM\Column(name="Pitfall", type="string", length=250, nullable=false)
     */
    private $pitfall;

    /**
     * @var string
     *
     * @ORM\Column(name="Allergy", type="string", length=250, nullable=false)
     */
    private $allergy;

    /**
     * @var string
     *
     * @ORM\Column(name="Challenge", type="string", length=250, nullable=false)
     */
    private $challenge;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Language", inversedBy="corequalities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LanguageId", referencedColumnName="Id")
     * })
     */
    private $language;

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="corequality1")
     */
    protected $corequalities1;

    public function __construct1()
    {
        $this->corequalities1 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="corequality2")
     */
    protected $corequalities2;

    public function __construct2()
    {
        $this->corequalities2 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="corequality3")
     */
    protected $corequalities3;

    public function __construct3()
    {
        $this->corequalities3 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="corequality4")
     */
    protected $corequalities4;

    public function __construct4()
    {
        $this->corequalities4 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="corequality5")
     */
    protected $corequalities5;

    public function __construct5()
    {
        $this->corequalities5 = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getCoreQuality();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->corequalities1 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->corequalities2 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->corequalities3 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->corequalities4 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->corequalities5 = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set coreQuality
     *
     * @param string $coreQuality
     * @return Corequality
     */
    public function setCoreQuality($coreQuality)
    {
        $this->coreQuality = $coreQuality;

        return $this;
    }

    /**
     * Get coreQuality
     *
     * @return string 
     */
    public function getCoreQuality()
    {
        return $this->coreQuality;
    }

    /**
     * Set pitfall
     *
     * @param string $pitfall
     * @return Corequality
     */
    public function setPitfall($pitfall)
    {
        $this->pitfall = $pitfall;

        return $this;
    }

    /**
     * Get pitfall
     *
     * @return string 
     */
    public function getPitfall()
    {
        return $this->pitfall;
    }

    /**
     * Set allergy
     *
     * @param string $allergy
     * @return Corequality
     */
    public function setAllergy($allergy)
    {
        $this->allergy = $allergy;

        return $this;
    }

    /**
     * Get allergy
     *
     * @return string 
     */
    public function getAllergy()
    {
        return $this->allergy;
    }

    /**
     * Set challenge
     *
     * @param string $challenge
     * @return Corequality
     */
    public function setChallenge($challenge)
    {
        $this->challenge = $challenge;

        return $this;
    }

    /**
     * Get challenge
     *
     * @return string 
     */
    public function getChallenge()
    {
        return $this->challenge;
    }

    /**
     * Set language
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Language $language
     * @return Corequality
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
     * Add corequalities1
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities1
     * @return Corequality
     */
    public function addCorequalities1(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities1)
    {
        $this->corequalities1[] = $corequalities1;

        return $this;
    }

    /**
     * Remove corequalities1
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities1
     */
    public function removeCorequalities1(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities1)
    {
        $this->corequalities1->removeElement($corequalities1);
    }

    /**
     * Get corequalities1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCorequalities1()
    {
        return $this->corequalities1;
    }

    /**
     * Add corequalities2
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities2
     * @return Corequality
     */
    public function addCorequalities2(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities2)
    {
        $this->corequalities2[] = $corequalities2;

        return $this;
    }

    /**
     * Remove corequalities2
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities2
     */
    public function removeCorequalities2(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities2)
    {
        $this->corequalities2->removeElement($corequalities2);
    }

    /**
     * Get corequalities2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCorequalities2()
    {
        return $this->corequalities2;
    }

    /**
     * Add corequalities3
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities3
     * @return Corequality
     */
    public function addCorequalities3(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities3)
    {
        $this->corequalities3[] = $corequalities3;

        return $this;
    }

    /**
     * Remove corequalities3
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities3
     */
    public function removeCorequalities3(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities3)
    {
        $this->corequalities3->removeElement($corequalities3);
    }

    /**
     * Get corequalities3
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCorequalities3()
    {
        return $this->corequalities3;
    }

    /**
     * Add corequalities4
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities4
     * @return Corequality
     */
    public function addCorequalities4(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities4)
    {
        $this->corequalities4[] = $corequalities4;

        return $this;
    }

    /**
     * Remove corequalities4
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities4
     */
    public function removeCorequalities4(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities4)
    {
        $this->corequalities4->removeElement($corequalities4);
    }

    /**
     * Get corequalities4
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCorequalities4()
    {
        return $this->corequalities4;
    }

    /**
     * Add corequalities5
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities5
     * @return Corequality
     */
    public function addCorequalities5(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities5)
    {
        $this->corequalities5[] = $corequalities5;

        return $this;
    }

    /**
     * Remove corequalities5
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $corequalities5
     */
    public function removeCorequalities5(\IntoPeople\DatabaseBundle\Entity\Cdp $corequalities5)
    {
        $this->corequalities5->removeElement($corequalities5);
    }

    /**
     * Get corequalities5
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCorequalities5()
    {
        return $this->corequalities5;
    }
}
