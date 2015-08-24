<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Systemmail
 *
 * @ORM\Table(name="SystemMail", indexes={@ORM\Index(name="LanguageId", columns={"LanguageId"}), @ORM\Index(name="OrganizationId", columns={"OrganizationId"})})
 * @ORM\Entity
 */
class Systemmail
{
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=250, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Sender", type="string", length=250, nullable=true)
     */
    private $sender;

    /**
     * @var string
     *
     * @ORM\Column(name="Subject", type="string", length=250, nullable=true)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="Text", type="text", length=65535, nullable=true)
     */
    private $text;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LanguageId", referencedColumnName="Id")
     * })
     */
    private $languageid;

    /**
     * @var \IntoPeople\DatabaseBundle\Entity\Organization
     *
     * @ORM\ManyToOne(targetEntity="IntoPeople\DatabaseBundle\Entity\Organization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="OrganizationId", referencedColumnName="Id")
     * })
     */
    private $organizationid;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Systemmail
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
     * Set sender
     *
     * @param string $sender
     *
     * @return Systemmail
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Systemmail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Systemmail
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
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
     * Set languageid
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Language $languageid
     *
     * @return Systemmail
     */
    public function setLanguageid(\IntoPeople\DatabaseBundle\Entity\Language $languageid = null)
    {
        $this->languageid = $languageid;

        return $this;
    }

    /**
     * Get languageid
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Language
     */
    public function getLanguageid()
    {
        return $this->languageid;
    }

    /**
     * Set organizationid
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Organization $organizationid
     *
     * @return Systemmail
     */
    public function setOrganizationid(\IntoPeople\DatabaseBundle\Entity\Organization $organizationid = null)
    {
        $this->organizationid = $organizationid;

        return $this;
    }

    /**
     * Get organizationid
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Organization
     */
    public function getOrganizationid()
    {
        return $this->organizationid;
    }
}
