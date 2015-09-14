<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Organization
 *
 * @ORM\Table(name="Organization", indexes={@ORM\Index(name="OrganizationStatusId", columns={"OrganizationStatusId"})})
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Organization
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
     * @ORM\Column(name="Name", type="string", length=250, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=250, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="About", type="text", length=65535, nullable=true)
     */
    private $about;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="organization_logo", fileNameProperty="logoName")
     *
     * @var File
     */
    private $logoFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $logoName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="Theme", type="string", length=250, nullable=true)
     */
    private $theme;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Organizationstatus
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Organizationstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="OrganizationStatusId", referencedColumnName="Id")
     * })
     */
    private $organizationstatus;


    public function __toString()
    {
        return $this->getName();
    }
    
    
    /**
     * @ORM\OneToMany(targetEntity="Generalcycle", mappedBy="organization")
     */
    protected $generalcycles;
    
    public function __construct1()
    {
        $this->generalcycles = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="User", cascade={"persist"}, mappedBy="organization")
     */
    protected $users;
    
    public function __construct2()
    {
        $this->users = new ArrayCollection();
    }
    
    
    /**
     * @ORM\OneToMany(targetEntity="Cdptemplate", mappedBy="organization")
     */
    protected $cdptemplates;
    
    public function __construct3()
    {
        $this->cdptemplates = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Midyeartemplate", mappedBy="organization")
     */
    protected $midyeartemplates;
    
    public function __construct4()
    {
        $this->midyeartemplates = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Endyeartemplate", mappedBy="organization")
     */
    protected $endyeartemplates;
    
    public function __construct5()
    {
        $this->endyeartemplates = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Organization
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
     * Set email
     *
     * @param string $email
     *
     * @return Organization
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Organization
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
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
     * Add generalcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle
     *
     * @return Organization
     */
    public function addGeneralcycle(\IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle)
    {
        $this->generalcycles[] = $generalcycle;

        return $this;
    }

    /**
     * Remove generalcycle
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle
     */
    public function removeGeneralcycle(\IntoPeople\DatabaseBundle\Entity\Generalcycle $generalcycle)
    {
        $this->generalcycles->removeElement($generalcycle);
    }

    /**
     * Get generalcycles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGeneralcycles()
    {
        return $this->generalcycles;
    }

    /**
     * Set organizationstatus
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Organizationstatus $organizationstatus
     *
     * @return Organization
     */
    public function setOrganizationstatus(\IntoPeople\DatabaseBundle\Entity\Organizationstatus $organizationstatus = null)
    {
        $this->organizationstatus = $organizationstatus;

        return $this;
    }

    /**
     * Get organizationstatus
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Organizationstatus
     */
    public function getOrganizationstatus()
    {
        return $this->organizationstatus;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->generalcycles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cdptemplates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cdptemplate
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdptemplate $cdptemplate
     *
     * @return Organization
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
     * @return Organization
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
     * @return Organization
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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setLogoFile(File $image = null)
    {
        $this->logoFile = $image;
    
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }
    
    /**
     * @return File
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }
    

    /**
     * Set logoName
     *
     * @param string $logoName
     *
     * @return Organization
     */
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;

        return $this;
    }

    /**
     * Get logoName
     *
     * @return string
     */
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Organization
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add users
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $users
     * @return Organization
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
     * Set about
     *
     * @param string $about
     * @return Organization
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }
}
