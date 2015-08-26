<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadGeneralcyclestatus.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Systemmail;
use Doctrine\Common\DataFixtures\AbstractFixture;


class LoadSystemmail extends AbstractFixture implements OrderedFixtureInterface
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
        
        $created->setName('Account created mail');
        $weekbeforedeadline->setName('Week before deadline mail');
        $newcycle->setName('New cycle ready mail');
        $newfeedback->setName('New feedback mail');
        $formtosupervisor->setName('Form sent to supervisor mail');
        $formtohr->setName('Form sent to HR mail');

        $created->setLanguageid($this->getReference('english'));
        $weekbeforedeadline->setLanguageid($this->getReference('english'));
        $newcycle->setLanguageid($this->getReference('english'));
        $newfeedback->setLanguageid($this->getReference('english'));
        $formtosupervisor->setLanguageid($this->getReference('english'));
        $formtohr->setLanguageid($this->getReference('english'));

        $created->setIsActive(true);
        $weekbeforedeadline->setIsActive(true);
        $newcycle->setIsActive(true);
        $newfeedback->setIsActive(true);
        $formtosupervisor->setIsActive(true);
        $formtohr->setIsActive(true);

        $manager->persist($created);
        $manager->persist($weekbeforedeadline);
        $manager->persist($newcycle);
        $manager->persist($newfeedback);
        $manager->persist($formtosupervisor);
        $manager->persist($formtohr);
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