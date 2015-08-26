<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadGeneralcyclestatus.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Systemmail;


class LoadSystemmail implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $created = new Systemmail();
        $weekbeforedeadline = new Systemmail();
        $newcycle = new Systemmail();
        $newfeedback = new Systemmail();
        $formtosupervisor = new Systemmail();
        $formtohr = new Systemmail();

        $english = $manager->getRepository('IntoPeopleDatabaseBundle:Language')->find(1);
        
        $created->setName('Account created mail');
        $weekbeforedeadline->setName('Week before deadline mail');
        $newcycle->setName('New cycle ready mail');
        $newfeedback->setName('New feedback mail');
        $formtosupervisor->setName('Form sent to supervisor mail');
        $formtohr->setName('Form sent to HR mail');

        $created->setLanguageid($english);
        $weekbeforedeadline->setLanguageid($english);
        $newcycle->setLanguageid($english);
        $newfeedback->setLanguageid($english);
        $formtosupervisor->setLanguageid($english);
        $formtohr->setLanguageid($english);

        $manager->persist($created);
        $manager->persist($weekbeforedeadline);
        $manager->persist($newcycle);
        $manager->persist($newfeedback);
        $manager->persist($formtosupervisor);
        $manager->persist($formtohr);
        $manager->flush();
    }
}