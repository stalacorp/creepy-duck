<?php

namespace IntoPeople\DatabaseBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity
 * @ORM\Table(name="intopeople_user")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(name="Id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="FirstName", type="string", length=250, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="LastName", type="string", length=250, nullable=true)
     */
    private $lastname;

    /**
     * @Vich\UploadableField(mapping="person_photo", fileNameProperty="photoname", nullable=true)
     *
     * @var File
     */
    private $photo;

    /**
     * @ORM\Column(name="PhotoName", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $photoname;

    /**
     * @ORM\Column(name="UpdatedAt", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HireDate", type="date", nullable=true)
     */
    private $hiredate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateLastPromotion", type="date", nullable=true)
     */
    private $datelastpromotion;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Language", inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LanguageId", referencedColumnName="Id")
     * })
     */
    private $language;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\User", inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SupervisorId", referencedColumnName="Id")
     * })
     */
    private $supervisor;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Userstatus
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Userstatus", inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UserStatusId", referencedColumnName="Id")
     * })
     */
    private $userstatus;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Organization
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Organization", cascade={"persist"},  inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="OrganizationId", referencedColumnName="Id")
     * })
     */
    private $organization;

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\Feedbackcycle", mappedBy="user")
     */
    protected $feedbackcycles;

    public function __construct1()
    {
        $this->feedbackcycles = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="IntoPeople\DatabaseBundle\Entity\User", mappedBy="supervisor")
     */
    protected $users;

    public function __construct2()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * TO STRING
     */
    public function __toString()
    {
        return $this->getFirstname() . " " . $this->getLastname();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->feedbackcycles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set photoname
     *
     * @param string $photoname
     * @return User
     */
    public function setPhotoname($photoname)
    {
        $this->photoname = $photoname;

        return $this;
    }

    /**
     * Get photoname
     *
     * @return string 
     */
    public function getPhotoname()
    {
        return $this->photoname;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
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
     * Set hiredate
     *
     * @param \DateTime $hiredate
     * @return User
     */
    public function setHiredate($hiredate)
    {
        $this->hiredate = $hiredate;

        return $this;
    }

    /**
     * Get hiredate
     *
     * @return \DateTime 
     */
    public function getHiredate()
    {
        return $this->hiredate;
    }

    /**
     * Set datelastpromotion
     *
     * @param \DateTime $datelastpromotion
     * @return User
     */
    public function setDatelastpromotion($datelastpromotion)
    {
        $this->datelastpromotion = $datelastpromotion;

        return $this;
    }

    /**
     * Get datelastpromotion
     *
     * @return \DateTime 
     */
    public function getDatelastpromotion()
    {
        return $this->datelastpromotion;
    }

    /**
     * Set language
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Language $language
     * @return User
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
     * Set supervisor
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $supervisor
     * @return User
     */
    public function setSupervisor(\IntoPeople\DatabaseBundle\Entity\User $supervisor = null)
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    /**
     * Get supervisor
     *
     * @return \IntoPeople\DatabaseBundle\Entity\User 
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Set userstatus
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Userstatus $userstatus
     * @return User
     */
    public function setUserstatus(\IntoPeople\DatabaseBundle\Entity\Userstatus $userstatus = null)
    {
        $this->userstatus = $userstatus;

        return $this;
    }

    /**
     * Get userstatus
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Userstatus 
     */
    public function getUserstatus()
    {
        return $this->userstatus;
    }

    /**
     * Set organization
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Organization $organization
     * @return User
     */
    public function setOrganization(\IntoPeople\DatabaseBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Add feedbackcycles
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycles
     * @return User
     */
    public function addFeedbackcycle(\IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycles)
    {
        $this->feedbackcycles[] = $feedbackcycles;

        return $this;
    }

    /**
     * Remove feedbackcycles
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycles
     */
    public function removeFeedbackcycle(\IntoPeople\DatabaseBundle\Entity\Feedbackcycle $feedbackcycles)
    {
        $this->feedbackcycles->removeElement($feedbackcycles);
    }

    /**
     * Get feedbackcycles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFeedbackcycles()
    {
        return $this->feedbackcycles;
    }

    /**
     * Add users
     *
     * @param \IntoPeople\DatabaseBundle\Entity\User $users
     * @return User
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
