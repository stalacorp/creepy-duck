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
        
        $cdptemplate->setSelfassesment("Self Assessment");
        $cdptemplate->setSelfassesmentDescription("Complete at least three, no more than five items for both strengths and development needs. ");
        $cdptemplate->setTalents("Talents");
        $cdptemplate->setTalentsDescription("What am i particularly good at (think about situations and activities that you enjoy, for which you receive compliments, where others ask you for help)?");
        $cdptemplate->setChallenges("Challenges");
        $cdptemplate->setChallengesDescription("What are areas that require improvement (think about situations and activities that you struggle with, that ask a lot of your energy, where conflict occurs, where you ask/need help with)?");
        $cdptemplate->setWhatwhy("What & why");
        $cdptemplate->setWhatwhyDescription("Write down the actions you will take this year, to further develop yourself, in your job. What do you want to do more and/or what are new things you want to take up. Why (what motivates you)?   ");
        $cdptemplate->setHow("How");
        $cdptemplate->setHowDescription("How will you do this? ");
        $cdptemplate->setSuccess("Success");
        $cdptemplate->setSuccessDescription("How will you know you succeeded? ");
        $cdptemplate->setNeeds("Needs");
        $cdptemplate->setNeedsDescription("What help do you need (training, knowledge sharing, books, tools, etc.)? ");
        $cdptemplate->setCareerobjectives("Career Objectives / Staffing Considerations");
        $cdptemplate->setCareerobjectivesQuestion("Where do you see yourself in three years?");
        $cdptemplate->setAdditionalinformation("Additional Information");
        $cdptemplate->setAdditionalinformationQuestion("List any additional information that is relevant to your Career Development Plan (CDP) for the coming year. Such information could include your interest in special assignments, considerations related to work / life balance, etc.");
        $cdptemplate->setSupervisorComment("Supervisor Comments");
        $cdptemplate->setFeedback("Feedback BOD");
        $cdptemplate->setSignatureSupervisor("Date & supervisor's Signature");
        $cdptemplate->setSignatureEmployee("Date & Employee's Signature");
        $cdptemplate->setLanguage($this->getReference('english'));
        
        $dt = new \DateTime();
        
        $cdptemplate->setDate($dt);
        $cdptemplate->setIsstandardtemplate(true);
        

        $manager->persist($cdptemplate);
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}