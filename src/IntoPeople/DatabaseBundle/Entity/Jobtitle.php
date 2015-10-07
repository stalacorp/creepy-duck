<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jobtitle
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Jobtitle
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\User", cascade={"persist"}, mappedBy="jobtitle")
     */
    protected $users;

    public function __construct1()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Cdp", cascade={"persist"}, mappedBy="jobtitle")
     */
    protected $cdps;

    public function __construct2()
    {
        $this->cdps = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Jobtitle
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
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cdps = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $users
     * @return Jobtitle
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
     * Add cdps
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdps
     * @return Jobtitle
     */
    public function addCdp(\IntoPeople\DatabaseBundle\Entity\Cdp $cdps)
    {
        $this->cdps[] = $cdps;

        return $this;
    }

    /**
     * Remove cdps
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdps
     */
    public function removeCdp(\IntoPeople\DatabaseBundle\Entity\Cdp $cdps)
    {
        $this->cdps->removeElement($cdps);
    }

    /**
     * Get cdps
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCdps()
    {
        return $this->cdps;
    }
}
