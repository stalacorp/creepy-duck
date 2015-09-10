<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadMidyeartemplate.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use IntoPeople\DatabaseBundle\Entity\Midyeartemplate;
use Proxies\__CG__\IntoPeople\DatabaseBundle\Entity\Midyear;


class LoadMidyeartemplate extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $midyeartemplate = new Midyeartemplate();

        $midyeartemplate->setMainTitle('Mid Year');
        $midyeartemplate->setTitle1('Personalia');

        $midyeartemplate->setName('Name');
        $midyeartemplate->setSupervisor('Supervisor');
        $midyeartemplate->setDateDiscussion('Date discussion');
        $midyeartemplate->setTeam('Team');
        $midyeartemplate->setFunction('Job Title');

        $midyeartemplate->setTitle2("Self Assessment");
        $midyeartemplate->setTitle2Description("Complete at least three, no more than five items for both strengths and development needs. ");

        $midyeartemplate->setTable2Col1("Talents");
        $midyeartemplate->setTable2Col2("Challenges");
        $midyeartemplate->setTable2Col3("How");
        $midyeartemplate->setTable2Col4("Success");
        $midyeartemplate->setTable2Col5("Needs");

        $midyeartemplate->setTable2Col1Descr("What are you good at?");
        $midyeartemplate->setTable2Col2Descr("So what is your challenge?");
        $midyeartemplate->setTable2Col3Descr("How are you going to take on this challenge?");
        $midyeartemplate->setTable2Col4Descr("How will you know if you succeeded?");
        $midyeartemplate->setTable2Col5Descr("What do you need to complete your challenge?");

        $midyeartemplate->setTitle3('Development Needs for your Job');
        $midyeartemplate->setTitle3Description('Read your Job Description carefully.');

        $midyeartemplate->setTable3Col1("What & why");
        $midyeartemplate->setTable3Col2("Progression");

        $midyeartemplate->setTable3Col1Descr("Find stated objectives and motivation as agreed upon at the start of this year.");
        $midyeartemplate->setTable3Col2Descr("How is it going?");


        $midyeartemplate->setTable3Title1('Job Specific Tasks and Responsibilities');
        $midyeartemplate->setTable3Title2('Job Specific Skills and Competencies');
        $midyeartemplate->setTable3Title3('Organization Competencies');

        $midyeartemplate->setTitle4("Feedback for your");
        $midyeartemplate->setQuestion1("Where do you see yourself in three years?");
        $midyeartemplate->setQuestion2("List any additional information that is relevant to your Career Development Plan (CDP) for the coming year. Such information could include your interest in special assignments, considerations related to work / life balance, etc.");

        $midyeartemplate->setSupervisorComment("Supervisor Comments");
        $midyeartemplate->setFeedback("Feedback BOD");
        $midyeartemplate->setSignatureSupervisor("Date & supervisor's Signature");
        $midyeartemplate->setSignatureEmployee("Date & Employee's Signature");
        $midyeartemplate->setLanguage($this->getReference('english'));

        $midyeartemplate->setTemplateversion($this->getReference('Templates2015'));

        $dt = new \DateTime();
        $midyeartemplate->setDate($dt);

        $midyeartemplate->setOrganization($this->getReference('organization'));

        $manager->persist($midyeartemplate);
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}