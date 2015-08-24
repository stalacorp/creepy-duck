<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadMidyeartemplate.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use IntoPeople\DatabaseBundle\Entity\Midyeartemplate;



class LoadMidyeartemplate extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {       
        $midyeartemplate = new Midyeartemplate();
 
        $midyeartemplate->setBigTitle("Year End");
        $midyeartemplate->setTitle1("Personalia");
        $midyeartemplate->setTitle2("Mid year review on progression of set goals");
        $midyeartemplate->setTitle3("Feedback for your supervisor");
        $midyeartemplate->setTitle4("Feedback for your organization");
        $midyeartemplate->setSmallTitle1("Job Specific Tasks and Responsibilities");
        $midyeartemplate->setSmallTitle2("Job Specific Skills and Competencies");
        $midyeartemplate->setSmallTitle3("Move Intermodal Competencies");
        
        $midyeartemplate->setWhatwhy("What & why");
        $midyeartemplate->setWhatwhydescription("Find stated objectives and motivation as agreed upon at the start of this year.");
        $midyeartemplate->setProgress("Progression");
        $midyeartemplate->setProgressdescription("How is it going?");
        $midyeartemplate->setOrganizationfield("Feedback for your organization");
        $midyeartemplate->setFeedbacksup("Feedback for your supervisor");
        $midyeartemplate->setFeedbacksupdescription("Positive feedback or points of attention for your supervisor");
        $midyeartemplate->setFeedbackorganizationdescription("Positive feedback and/or points of attention for your organization");
        
        $dt = new \DateTime();              
        
        $midyeartemplate->setDate($dt);
        $midyeartemplate->setIsstandardtemplate(true);
        $midyeartemplate->setLanguage($this->getReference('english'));
        

        $manager->persist($midyeartemplate);
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