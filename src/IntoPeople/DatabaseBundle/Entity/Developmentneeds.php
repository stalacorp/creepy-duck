<?php

namespace IntoPeople\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Developmentneeds
 *
 * @ORM\Table(name="DevelopmentNeeds")
 * @ORM\Entity
 */
class Developmentneeds
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
     * @ORM\OneToOne(targetEntity="Endyear", mappedBy="developmentneeds")
     */
    protected $endyear;
    
    /**
     * @ORM\OneToOne(targetEntity="Midyear", mappedBy="developmentneeds")
     */
    protected $midyear;
        
    /**
     * @ORM\OneToOne(targetEntity="Cdp", cascade={"persist"}, mappedBy="developmentneeds")
     */
    protected $cdp;
        
    /**
     * @var string
     *
     * @ORM\Column(name="Task1", type="text", length=65535, nullable=true)
     */
    private $task1;

    /**
     * @var string
     *
     * @ORM\Column(name="Task2", type="text", length=65535, nullable=true)
     */
    private $task2;

    /**
     * @var string
     *
     * @ORM\Column(name="Task3", type="text", length=65535, nullable=true)
     */
    private $task3;

    /**
     * @var string
     *
     * @ORM\Column(name="Task4", type="text", length=65535, nullable=true)
     */
    private $task4;

    /**
     * @var string
     *
     * @ORM\Column(name="Task5", type="text", length=65535, nullable=true)
     */
    private $task5;

    /**
     * @var string
     *
     * @ORM\Column(name="Skill1", type="text", length=65535, nullable=true)
     */
    private $skill1;

    /**
     * @var string
     *
     * @ORM\Column(name="Skill2", type="text", length=65535, nullable=true)
     */
    private $skill2;

    /**
     * @var string
     *
     * @ORM\Column(name="Skill3", type="text", length=65535, nullable=true)
     */
    private $skill3;

    /**
     * @var string
     *
     * @ORM\Column(name="Skill4", type="text", length=65535, nullable=true)
     */
    private $skill4;

    /**
     * @var string
     *
     * @ORM\Column(name="Skill5", type="text", length=65535, nullable=true)
     */
    private $skill5;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationCompetence1", type="text", length=65535, nullable=true)
     */
    private $organizationcompetence1;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationCompetence2", type="text", length=65535, nullable=true)
     */
    private $organizationcompetence2;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationCompetence3", type="text", length=65535, nullable=true)
     */
    private $organizationcompetence3;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationCompetence4", type="text", length=65535, nullable=true)
     */
    private $organizationcompetence4;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationCompetence5", type="text", length=65535, nullable=true)
     */
    private $organizationcompetence5;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationDescription1", type="text", length=65535, nullable=true)
     */
    private $organizationdescription1;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationDescription2", type="text", length=65535, nullable=true)
     */
    private $organizationdescription2;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationDescription3", type="text", length=65535, nullable=true)
     */
    private $organizationdescription3;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationDescription4", type="text", length=65535, nullable=true)
     */
    private $organizationdescription4;

    /**
     * @var string
     *
     * @ORM\Column(name="OrganizationDescription5", type="text", length=65535, nullable=true)
     */
    private $organizationdescription5;

    /**
     * Set task1
     *
     * @param string $task1
     *
     * @return Developmentneeds
     */
    public function setTask1($task1)
    {
        $this->task1 = $task1;

        return $this;
    }

    /**
     * Get task1
     *
     * @return string
     */
    public function getTask1()
    {
        return $this->task1;
    }

    /**
     * Set task2
     *
     * @param string $task2
     *
     * @return Developmentneeds
     */
    public function setTask2($task2)
    {
        $this->task2 = $task2;

        return $this;
    }

    /**
     * Get task2
     *
     * @return string
     */
    public function getTask2()
    {
        return $this->task2;
    }

    /**
     * Set task3
     *
     * @param string $task3
     *
     * @return Developmentneeds
     */
    public function setTask3($task3)
    {
        $this->task3 = $task3;

        return $this;
    }

    /**
     * Get task3
     *
     * @return string
     */
    public function getTask3()
    {
        return $this->task3;
    }

    /**
     * Set task4
     *
     * @param string $task4
     *
     * @return Developmentneeds
     */
    public function setTask4($task4)
    {
        $this->task4 = $task4;

        return $this;
    }

    /**
     * Get task4
     *
     * @return string
     */
    public function getTask4()
    {
        return $this->task4;
    }

    /**
     * Set task5
     *
     * @param string $task5
     *
     * @return Developmentneeds
     */
    public function setTask5($task5)
    {
        $this->task5 = $task5;

        return $this;
    }

    /**
     * Get task5
     *
     * @return string
     */
    public function getTask5()
    {
        return $this->task5;
    }

    /**
     * Set skill1
     *
     * @param string $skill1
     *
     * @return Developmentneeds
     */
    public function setSkill1($skill1)
    {
        $this->skill1 = $skill1;

        return $this;
    }

    /**
     * Get skill1
     *
     * @return string
     */
    public function getSkill1()
    {
        return $this->skill1;
    }

    /**
     * Set skill2
     *
     * @param string $skill2
     *
     * @return Developmentneeds
     */
    public function setSkill2($skill2)
    {
        $this->skill2 = $skill2;

        return $this;
    }

    /**
     * Get skill2
     *
     * @return string
     */
    public function getSkill2()
    {
        return $this->skill2;
    }

    /**
     * Set skill3
     *
     * @param string $skill3
     *
     * @return Developmentneeds
     */
    public function setSkill3($skill3)
    {
        $this->skill3 = $skill3;

        return $this;
    }

    /**
     * Get skill3
     *
     * @return string
     */
    public function getSkill3()
    {
        return $this->skill3;
    }

    /**
     * Set skill4
     *
     * @param string $skill4
     *
     * @return Developmentneeds
     */
    public function setSkill4($skill4)
    {
        $this->skill4 = $skill4;

        return $this;
    }

    /**
     * Get skill4
     *
     * @return string
     */
    public function getSkill4()
    {
        return $this->skill4;
    }

    /**
     * Set skill5
     *
     * @param string $skill5
     *
     * @return Developmentneeds
     */
    public function setSkill5($skill5)
    {
        $this->skill5 = $skill5;

        return $this;
    }

    /**
     * Get skill5
     *
     * @return string
     */
    public function getSkill5()
    {
        return $this->skill5;
    }

    /**
     * Set organizationcompetence1
     *
     * @param string $organizationcompetence1
     *
     * @return Developmentneeds
     */
    public function setOrganizationcompetence1($organizationcompetence1)
    {
        $this->organizationcompetence1 = $organizationcompetence1;

        return $this;
    }

    /**
     * Get organizationcompetence1
     *
     * @return string
     */
    public function getOrganizationcompetence1()
    {
        return $this->organizationcompetence1;
    }

    /**
     * Set organizationcompetence2
     *
     * @param string $organizationcompetence2
     *
     * @return Developmentneeds
     */
    public function setOrganizationcompetence2($organizationcompetence2)
    {
        $this->organizationcompetence2 = $organizationcompetence2;

        return $this;
    }

    /**
     * Get organizationcompetence2
     *
     * @return string
     */
    public function getOrganizationcompetence2()
    {
        return $this->organizationcompetence2;
    }

    /**
     * Set organizationcompetence3
     *
     * @param string $organizationcompetence3
     *
     * @return Developmentneeds
     */
    public function setOrganizationcompetence3($organizationcompetence3)
    {
        $this->organizationcompetence3 = $organizationcompetence3;

        return $this;
    }

    /**
     * Get organizationcompetence3
     *
     * @return string
     */
    public function getOrganizationcompetence3()
    {
        return $this->organizationcompetence3;
    }

    /**
     * Set organizationcompetence4
     *
     * @param string $organizationcompetence4
     *
     * @return Developmentneeds
     */
    public function setOrganizationcompetence4($organizationcompetence4)
    {
        $this->organizationcompetence4 = $organizationcompetence4;

        return $this;
    }

    /**
     * Get organizationcompetence4
     *
     * @return string
     */
    public function getOrganizationcompetence4()
    {
        return $this->organizationcompetence4;
    }

    /**
     * Set organizationcompetence5
     *
     * @param string $organizationcompetence5
     *
     * @return Developmentneeds
     */
    public function setOrganizationcompetence5($organizationcompetence5)
    {
        $this->organizationcompetence5 = $organizationcompetence5;

        return $this;
    }

    /**
     * Get organizationcompetence5
     *
     * @return string
     */
    public function getOrganizationcompetence5()
    {
        return $this->organizationcompetence5;
    }

    /**
     * Set organizationdescription1
     *
     * @param string $organizationdescription1
     *
     * @return Developmentneeds
     */
    public function setOrganizationdescription1($organizationdescription1)
    {
        $this->organizationdescription1 = $organizationdescription1;

        return $this;
    }

    /**
     * Get organizationdescription1
     *
     * @return string
     */
    public function getOrganizationdescription1()
    {
        return $this->organizationdescription1;
    }

    /**
     * Set organizationdescription2
     *
     * @param string $organizationdescription2
     *
     * @return Developmentneeds
     */
    public function setOrganizationdescription2($organizationdescription2)
    {
        $this->organizationdescription2 = $organizationdescription2;

        return $this;
    }

    /**
     * Get organizationdescription2
     *
     * @return string
     */
    public function getOrganizationdescription2()
    {
        return $this->organizationdescription2;
    }

    /**
     * Set organizationdescription3
     *
     * @param string $organizationdescription3
     *
     * @return Developmentneeds
     */
    public function setOrganizationdescription3($organizationdescription3)
    {
        $this->organizationdescription3 = $organizationdescription3;

        return $this;
    }

    /**
     * Get organizationdescription3
     *
     * @return string
     */
    public function getOrganizationdescription3()
    {
        return $this->organizationdescription3;
    }

    /**
     * Set organizationdescription4
     *
     * @param string $organizationdescription4
     *
     * @return Developmentneeds
     */
    public function setOrganizationdescription4($organizationdescription4)
    {
        $this->organizationdescription4 = $organizationdescription4;

        return $this;
    }

    /**
     * Get organizationdescription4
     *
     * @return string
     */
    public function getOrganizationdescription4()
    {
        return $this->organizationdescription4;
    }

    /**
     * Set organizationdescription5
     *
     * @param string $organizationdescription5
     *
     * @return Developmentneeds
     */
    public function setOrganizationdescription5($organizationdescription5)
    {
        $this->organizationdescription5 = $organizationdescription5;

        return $this;
    }

    /**
     * Get organizationdescription5
     *
     * @return string
     */
    public function getOrganizationdescription5()
    {
        return $this->organizationdescription5;
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
     * Set cdp
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Cdp $cdp
     *
     * @return Developmentneeds
     */
    public function setCdp(\IntoPeople\DatabaseBundle\Entity\Cdp $cdp = null)
    {
        $this->cdp = $cdp;

        return $this;
    }

    /**
     * Get cdp
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Cdp
     */
    public function getCdp()
    {
        return $this->cdp;
    }

    /**
     * Set midyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Midyear $midyear
     *
     * @return Developmentneeds
     */
    public function setMidyear(\IntoPeople\DatabaseBundle\Entity\Midyear $midyear = null)
    {
        $this->midyear = $midyear;

        return $this;
    }

    /**
     * Get midyear
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Midyear
     */
    public function getMidyear()
    {
        return $this->midyear;
    }

    /**
     * Set endyear
     *
     * @param \IntoPeople\DatabaseBundle\Entity\Endyear $endyear
     *
     * @return Developmentneeds
     */
    public function setEndyear(\IntoPeople\DatabaseBundle\Entity\Endyear $endyear = null)
    {
        $this->endyear = $endyear;

        return $this;
    }

    /**
     * Get endyear
     *
     * @return \IntoPeople\DatabaseBundle\Entity\Endyear
     */
    public function getEndyear()
    {
        return $this->endyear;
    }
}
