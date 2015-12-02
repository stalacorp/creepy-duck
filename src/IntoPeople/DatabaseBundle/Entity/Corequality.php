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
     * @var \IntoPeople\DatabaseBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Language", inversedBy="corequalities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LanguageId", referencedColumnName="Id")
     * })
     */
    private $language;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isStandard", type="boolean", nullable=true)
     */
    private $isStandard;

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
     * Set isStandard
     *
     * @param boolean $isStandard
     *
     * @return Mailtype
     */
    public function setIsStandard($isStandard)
    {
        $this->isStandard = $isStandard;

        return $this;
    }

    /**
     * Get isStandard
     *
     * @return boolean
     */
    public function getIsStandard()
    {
        return $this->isStandard;
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
     * Add challenges1
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges1
     * @return Corequality
     */
    public function addChallenges1(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges1)
    {
        $this->challenges1[] = $challenges1;

        return $this;
    }

    /**
     * Remove challenges1
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges1
     */
    public function removeChallenges1(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges1)
    {
        $this->challenges1->removeElement($challenges1);
    }

    /**
     * Get challenges1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChallenges1()
    {
        return $this->challenges1;
    }

    /**
     * Add challenges2
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges2
     * @return Corequality
     */
    public function addChallenges2(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges2)
    {
        $this->challenges2[] = $challenges2;

        return $this;
    }

    /**
     * Remove challenges2
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges2
     */
    public function removeChallenges2(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges2)
    {
        $this->challenges2->removeElement($challenges2);
    }

    /**
     * Get challenges2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChallenges2()
    {
        return $this->challenges2;
    }

    /**
     * Add challenges3
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges3
     * @return Corequality
     */
    public function addChallenges3(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges3)
    {
        $this->challenges3[] = $challenges3;

        return $this;
    }

    /**
     * Remove challenges3
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges3
     */
    public function removeChallenges3(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges3)
    {
        $this->challenges3->removeElement($challenges3);
    }

    /**
     * Get challenges3
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChallenges3()
    {
        return $this->challenges3;
    }

    /**
     * Add challenges4
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges4
     * @return Corequality
     */
    public function addChallenges4(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges4)
    {
        $this->challenges4[] = $challenges4;

        return $this;
    }

    /**
     * Remove challenges4
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges4
     */
    public function removeChallenges4(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges4)
    {
        $this->challenges4->removeElement($challenges4);
    }

    /**
     * Get challenges4
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChallenges4()
    {
        return $this->challenges4;
    }

    /**
     * Add challenges5
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges5
     * @return Corequality
     */
    public function addChallenges5(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges5)
    {
        $this->challenges5[] = $challenges5;

        return $this;
    }

    /**
     * Remove challenges5
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges5
     */
    public function removeChallenges5(\IntoPeople\DatabaseBundle\Entity\Cdp $challenges5)
    {
        $this->challenges5->removeElement($challenges5);
    }

    /**
     * Get challenges5
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChallenges5()
    {
        return $this->challenges5;
    }
}
