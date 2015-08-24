<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Text
 *
 * @ORM\Table(name="Text", indexes={@ORM\Index(name="LanguageId", columns={"LanguageId"})})
 * @ORM\Entity
 */
class Text
{
    /**
     * @var string
     *
     * @ORM\Column(name="Webpage", type="string", length=250, nullable=true)
     */
    private $webpage;

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
     * Set webpage
     *
     * @param string $webpage
     *
     * @return Text
     */
    public function setWebpage($webpage)
    {
        $this->webpage = $webpage;

        return $this;
    }

    /**
     * Get webpage
     *
     * @return string
     */
    public function getWebpage()
    {
        return $this->webpage;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Text
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
     * @return Text
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
     * @return Text
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
}
