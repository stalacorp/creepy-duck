<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Organizationstatus
 *
 * @ORM\Table(name="OrganizationStatus")
 * @ORM\Entity
 */
class Organizationstatus
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
     * @ORM\OneToMany(targetEntity="Organization", mappedBy="organizationstatus")
     */
    protected $organizations;
    
    public function __construct()
    {
        $this->organizations = new ArrayCollection();
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
     * @return Organizationstatus
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
     * Add organization
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Organization $organization
     *
     * @return Organizationstatus
     */
    public function addOrganization(\IntoPeople\DatabaseBundle\Entity\Organization $organization)
    {
        $this->organizations[] = $organization;

        return $this;
    }

    /**
     * Remove organization
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Organization $organization
     */
    public function removeOrganization(\IntoPeople\DatabaseBundle\Entity\Organization $organization)
    {
        $this->organizations->removeElement($organization);
    }

    /**
     * Get organizations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrganizations()
    {
        return $this->organizations;
    }
}
