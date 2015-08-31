<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Language
 *
 * @ORM\Table(name="Language")
 * @ORM\Entity
 */
class Language
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
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="language")
     */
    protected $users;
    
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Cdptemplate", mappedBy="language")
     */
    protected $cdptemplates;
    
    public function __construct2()
    {
        $this->cdptemplates = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Midyear", mappedBy="language")
     */
    protected $midyeartemplates;
    
    public function __construct3()
    {
        $this->midyeartemplates = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Endyear", mappedBy="language")
     */
    protected $endyeartemplates;
    
    public function __construct4()
    {
        $this->endyeartemplates = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Corequality", mappedBy="language")
     */
    protected $corequalities;

    public function __construct5()
    {
        $this->corequalities = new ArrayCollection();
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
     * @return Language
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
     * Add cdptemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplate
     *
     * @return Language
     */
    public function addCdptemplate(\IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplate)
    {
        $this->cdptemplates[] = $cdptemplate;

        return $this;
    }

    /**
     * Remove cdptemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplate
     */
    public function removeCdptemplate(\IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplate)
    {
        $this->cdptemplates->removeElement($cdptemplate);
    }

    /**
     * Get cdptemplates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdptemplates()
    {
        return $this->cdptemplates;
    }

    /**
     * Add midyeartemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyeartemplate
     *
     * @return Language
     */
    public function addMidyeartemplate(\IntoPeople\DatabaseBundle\Entity\Midyear $midyeartemplate)
    {
        $this->midyeartemplates[] = $midyeartemplate;

        return $this;
    }

    /**
     * Remove midyeartemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyeartemplate
     */
    public function removeMidyeartemplate(\IntoPeople\DatabaseBundle\Entity\Midyear $midyeartemplate)
    {
        $this->midyeartemplates->removeElement($midyeartemplate);
    }

    /**
     * Get midyeartemplates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMidyeartemplates()
    {
        return $this->midyeartemplates;
    }

    /**
     * Add endyeartemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyeartemplate
     *
     * @return Language
     */
    public function addEndyeartemplate(\IntoPeople\DatabaseBundle\Entity\Endyear $endyeartemplate)
    {
        $this->endyeartemplates[] = $endyeartemplate;

        return $this;
    }

    /**
     * Remove endyeartemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyeartemplate
     */
    public function removeEndyeartemplate(\IntoPeople\DatabaseBundle\Entity\Endyear $endyeartemplate)
    {
        $this->endyeartemplates->removeElement($endyeartemplate);
    }

    /**
     * Get endyeartemplates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEndyeartemplates()
    {
        return $this->endyeartemplates;
    }

    /**
     * Add users
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $users
     * @return Language
     */
    public function addUser(\IntoPeople\DatabaseBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $users
     */
    public function removeUser(\IntoPeople\DatabaseBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add corequalities
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Corequality $corequalities
     * @return Language
     */
    public function addCorequality(\IntoPeople\DatabaseBundle\Entity\Corequality $corequalities)
    {
        $this->corequalities[] = $corequalities;

        return $this;
    }

    /**
     * Remove corequalities
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Corequality $corequalities
     */
    public function removeCorequality(\IntoPeople\DatabaseBundle\Entity\Corequality $corequalities)
    {
        $this->corequalities->removeElement($corequalities);
    }

    /**
     * Get corequalities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCorequalities()
    {
        return $this->corequalities;
    }
}
