<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadEndyeartemplate.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use IntoPeople\DatabaseBundle\Entity\Endyeartemplate;



class LoadEndyeartemplate extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $endyeartemplate = new Endyeartemplate();

        $endyeartemplate->setMainTitle('Year End');
        $endyeartemplate->setTitle1('Personalia');

        $endyeartemplate->setName('Name');
        $endyeartemplate->setSupervisor('Supervisor');
        $endyeartemplate->setDateDiscussion('Date discussion');
        $endyeartemplate->setTeam('Team');
        $endyeartemplate->setFunction('Job Title');

        $endyeartemplate->setTitle2("Self Assessment");
        $endyeartemplate->setTitle2Description("Complete at least three, no more than five items for both strengths and development needs. ");

        $endyeartemplate->setTable2Col1("Talents");
        $endyeartemplate->setTable2Col2("Challenges");
        $endyeartemplate->setTable2Col3("How");
        $endyeartemplate->setTable2Col4("Success");
        $endyeartemplate->setTable2Col5("Needs");

        $endyeartemplate->setTable2Col1Descr("What are you good at?");
        $endyeartemplate->setTable2Col2Descr("So what is your challenge?");
        $endyeartemplate->setTable2Col3Descr("How are you going to take on this challenge?");
        $endyeartemplate->setTable2Col4Descr("How will you know if you succeeded?");
        $endyeartemplate->setTable2Col5Descr("What do you need to complete your challenge?");

        $endyeartemplate->setTitle3('Development Needs for your Job');
        $endyeartemplate->setTitle3Description('Read your Job Description carefully.');

        $endyeartemplate->setTable3Col1("What & why");
        $endyeartemplate->setTable3Col2("How");

        $endyeartemplate->setTable3Col1Descr("Write down the actions you will take this year to further develop yourself in your job.");
        $endyeartemplate->setTable3Col2Descr("How will you do this?");


        $endyeartemplate->setTable3Title1('Job Specific Tasks and Responsibilities');
        $endyeartemplate->setTable3Title2('Job Specific Skills and Competencies');
        $endyeartemplate->setTable3Title3('Organization Competencies');

        $endyeartemplate->setTitle4("Career Objectives / Staffing Considerations");
        $endyeartemplate->setQuestion1("Share your ideas, working areas for your team.");
        $endyeartemplate->setQuestion2("Share your ideas, workings areas for the other teams.");
        $endyeartemplate->setQuestion3("Share strengths and development needs for your supervisor from your experience.");
        $endyeartemplate->setQuestion4("Share feedback for your organization in terms of working environment, health and safety, available tools and gear, etc.");

        $endyeartemplate->setSupervisorComment("Supervisor Comments");
        $endyeartemplate->setFeedback("Feedback BOD");
        $endyeartemplate->setSignatureSupervisor("Date & supervisor's Signature");
        $endyeartemplate->setSignatureEmployee("Date & Employee's Signature");
        $endyeartemplate->setLanguage($this->getReference('english'));

        $endyeartemplate->setTemplateversion($this->getReference('Templates2015'));

        $dt = new \DateTime();
        $endyeartemplate->setDate($dt);

        $endyeartemplate->setOrganization($this->getReference('organization'));

        $manager->persist($endyeartemplate);
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }
}