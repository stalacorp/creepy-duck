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
        
        $endyeartemplate->setWhatwhy("What & why");
        $endyeartemplate->setWhatwhydescription("Find stated objectives and motivation as agreed upon at the start of this year.");
        $endyeartemplate->setEvaluation("Self Assessment ");
        $endyeartemplate->setEvaluationdescription("How did you do? What went well? What could have gone better? ");
        $endyeartemplate->setTasks("Job Specific Tasks and Responsibilities");
        $endyeartemplate->setSkills("Job Specific Skills and Competencies");
        $endyeartemplate->setOrganizationfield("Organization Competencies ");
        $endyeartemplate->setFeedbackOrganization("Feedback for your organization");
        $endyeartemplate->setFeedbackOrganizationDescription1("Share your ideas, working areas for your team ");
        $endyeartemplate->setFeedbackOrganizationDescription2("Share your ideas, working areas for the the other teams ");
        $endyeartemplate->setFeedbackOrganizationDescription3("Share strengths and development needs for your supervisor from your experience ");
        $endyeartemplate->setFeedbackOrganizationDescription4("Share feedback for Move Intermodal in terms of working environment, health and safety, available tools and gear, etc.");
      
        $dt = new \DateTime();              
        
        $endyeartemplate->setDate($dt);
        $endyeartemplate->setIsstandardtemplate(true);
        $endyeartemplate->setLanguage($this->getReference('english'));
        
        $manager->persist($endyeartemplate);
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