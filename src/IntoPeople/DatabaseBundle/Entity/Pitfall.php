<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pitfall
 *
 * @ORM\Table(name="Pitfall", indexes={@ORM\Index(name="LanguageId", columns={"LanguageId"})})
 * @ORM\Entity
 */
class Pitfall
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
     * @ORM\Column(name="Pitfall", type="string", length=250, nullable=false)
     */
    private $pitfall;

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
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="pitfall1")
     */
    protected $pitfalls1;

    public function __construct1()
    {
        $this->pitfalls1 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="pitfall2")
     */
    protected $pitfalls2;

    public function __construct2()
    {
        $this->pitfalls2 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="pitfall3")
     */
    protected $pitfalls3;

    public function __construct3()
    {
        $this->pitfalls3 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="pitfall4")
     */
    protected $pitfalls4;

    public function __construct4()
    {
        $this->pitfalls4 = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="pitfall5")
     */
    protected $pitfalls5;

    public function __construct5()
    {
        $this->pitfalls5 = new ArrayCollection();
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
        $this->pitfalls1 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pitfalls2 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pitfalls3 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pitfalls4 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pitfalls5 = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set pitfall
     *
     * @param string $pitfall
     * @return Pitfall
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
     * Set isStandard
     *
     * @param boolean $isStandard
     * @return Pitfall
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
     * @return Pitfall
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
     * Add pitfalls1
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls1
     * @return Pitfall
     */
    public function addPitfalls1(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls1)
    {
        $this->pitfalls1[] = $pitfalls1;

        return $this;
    }

    /**
     * Remove pitfalls1
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls1
     */
    public function removePitfalls1(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls1)
    {
        $this->pitfalls1->removeElement($pitfalls1);
    }

    /**
     * Get pitfalls1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPitfalls1()
    {
        return $this->pitfalls1;
    }

    /**
     * Add pitfalls2
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls2
     * @return Pitfall
     */
    public function addPitfalls2(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls2)
    {
        $this->pitfalls2[] = $pitfalls2;

        return $this;
    }

    /**
     * Remove pitfalls2
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls2
     */
    public function removePitfalls2(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls2)
    {
        $this->pitfalls2->removeElement($pitfalls2);
    }

    /**
     * Get pitfalls2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPitfalls2()
    {
        return $this->pitfalls2;
    }

    /**
     * Add pitfalls3
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls3
     * @return Pitfall
     */
    public function addPitfalls3(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls3)
    {
        $this->pitfalls3[] = $pitfalls3;

        return $this;
    }

    /**
     * Remove pitfalls3
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls3
     */
    public function removePitfalls3(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls3)
    {
        $this->pitfalls3->removeElement($pitfalls3);
    }

    /**
     * Get pitfalls3
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPitfalls3()
    {
        return $this->pitfalls3;
    }

    /**
     * Add pitfalls4
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls4
     * @return Pitfall
     */
    public function addPitfalls4(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls4)
    {
        $this->pitfalls4[] = $pitfalls4;

        return $this;
    }

    /**
     * Remove pitfalls4
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls4
     */
    public function removePitfalls4(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls4)
    {
        $this->pitfalls4->removeElement($pitfalls4);
    }

    /**
     * Get pitfalls4
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPitfalls4()
    {
        return $this->pitfalls4;
    }

    /**
     * Add pitfalls5
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls5
     * @return Pitfall
     */
    public function addPitfalls5(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls5)
    {
        $this->pitfalls5[] = $pitfalls5;

        return $this;
    }

    /**
     * Remove pitfalls5
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls5
     */
    public function removePitfalls5(\IntoPeople\DatabaseBundle\Entity\Cdp $pitfalls5)
    {
        $this->pitfalls5->removeElement($pitfalls5);
    }

    /**
     * Get pitfalls5
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPitfalls5()
    {
        return $this->pitfalls5;
    }
}
