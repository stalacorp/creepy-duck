<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Challenge
 *
 * @ORM\Table(name="Challenge", indexes={@ORM\Index(name="LanguageId", columns={"LanguageId"})})
 * @ORM\Entity
 */
class Challenge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @var boolean
     *
     * @ORM\Column(name="isStandard", type="boolean", nullable=true)
     */
    private $isStandard;

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="challenge1")
     */
    protected $challenges1;

    public function __construct6()
    {
        $this->challenges1 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="challenge2")
     */
    protected $challenges2;

    public function __construct7()
    {
        $this->challenges2 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="challenge3")
     */
    protected $challenges3;

    public function __construct8()
    {
        $this->challenges3 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="challenge4")
     */
    protected $challenges4;

    public function __construct9()
    {
        $this->challenges4 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="challenge5")
     */
    protected $challenges5;

    public function __construct10()
    {
        $this->challenges5 = new ArrayCollection();
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
     * Constructor
     */
    public function __construct()
    {
        $this->challenges1 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->challenges2 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->challenges3 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->challenges4 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->challenges5 = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set challenge
     *
     * @param string $challenge
     * @return Challenge
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
     * Set isStandard
     *
     * @param boolean $isStandard
     * @return Challenge
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
     * Set language
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Language $language
     * @return Challenge
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
     * Add challenges1
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $challenges1
     * @return Challenge
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
     * @return Challenge
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
     * @return Challenge
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
     * @return Challenge
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
     * @return Challenge
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
