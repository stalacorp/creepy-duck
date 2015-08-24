<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userstatus
 *
 * @ORM\Table(name="UserStatus")
 * @ORM\Entity
 */
class Userstatus
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
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\User", mappedBy="userstatus")
     */
    protected $users;
    
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Userstatus
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add users
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $users
     * @return Userstatus
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
}
