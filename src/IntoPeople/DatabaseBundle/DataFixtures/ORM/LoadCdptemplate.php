<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadCdptemplate.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Cdptemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;



class LoadCdptemplate extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {       
        $cdptemplate = new Cdptemplate();

        $cdptemplate->setMainTitle('Career Development Plan');
        $cdptemplate->setTitle1('Personalia');

        $cdptemplate->setName('Name');
        $cdptemplate->setSupervisor('Supervisor');
        $cdptemplate->setDateDiscussion('Date discussion');
        $cdptemplate->setTeam('Team');
        $cdptemplate->setFunction('Job Title');

        $cdptemplate->setTitle2("Self Assessment");
        $cdptemplate->setTitle2Description("Complete at least three, no more than five items for both strengths and development needs. ");

        $cdptemplate->setTable2Col1("Talents");
        $cdptemplate->setTable2Col2("Challenges");
        $cdptemplate->setTable2Col3("Pitfall");
        $cdptemplate->setTable2Col4("How");
        $cdptemplate->setTable2Col5("Success");
        $cdptemplate->setTable2Col6("Needs");

        $cdptemplate->setTable2Col1Descr("What are you good at?");
        $cdptemplate->setTable2Col2Descr("So what is your challenge?");
        $cdptemplate->setTable2Col3Descr("How are you going to take on this challenge?");
        $cdptemplate->setTable2Col4Descr("How will you know if you succeeded?");
        $cdptemplate->setTable2Col5Descr("What do you need to complete your challenge?");

        $cdptemplate->setTitle3('Development Needs for your Job');
        $cdptemplate->setTitle3Description('Read your Job Description carefully.');

        $cdptemplate->setTable3Col1("What & why");
        $cdptemplate->setTable3Col2("How");
        $cdptemplate->setTable3Col3("Success");
        $cdptemplate->setTable3Col4("Needs");

        $cdptemplate->setTable3Col1Descr("Write down the actions you will take this year to further develop yourself in your job.");
        $cdptemplate->setTable3Col2Descr("How will you do this?");
        $cdptemplate->setTable3Col3Descr("How will you know if you succeeded?");
        $cdptemplate->setTable3Col4Descr("What do you need ( training, knowledge sharing, books, tools, etc. ) ?");

        $cdptemplate->setTable3Title1('Job Specific Tasks and Responsibilities');
        $cdptemplate->setTable3Title2('Job Specific Skills and Competencies');
        $cdptemplate->setTable3Title3('Organization Competencies');

        $cdptemplate->setTitle4("Career Objectives / Staffing Considerations");
        $cdptemplate->setQuestion1("Where do you see yourself in three years?");

        $cdptemplate->setTitle5("Additional Information");
        $cdptemplate->setQuestion2("List any additional information that is relevant to your Career Development Plan (CDP) for the coming year. Such information could include your interest in special assignments, considerations related to work / life balance, etc.");

        $cdptemplate->setSupervisorComment("Supervisor Comments");
        $cdptemplate->setFeedback("Feedback MT");
        $cdptemplate->setSignatureSupervisor("Date & supervisor's Signature");
        $cdptemplate->setSignatureEmployee("Date & Employee's Signature");
        $cdptemplate->setLanguage($this->getReference('english'));
        
        $dt = new \DateTime();
        $cdptemplate->setDate($dt);

        $cdptemplate->setOrganization($this->getReference('organization'));

        $manager->persist($cdptemplate);
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}