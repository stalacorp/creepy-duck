<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadGeneralcyclestatus.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Systemmail;
use Doctrine\Common\DataFixtures\AbstractFixture;
use IntoPeople\DatabaseBundle\Entity\Mailtype;


class LoadSystemmail extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $createdtype = new Mailtype();
        $weekbeforedeadlinetype = new Mailtype();
        $newcycletype = new Mailtype();
        $newfeedbacktype = new Mailtype();
        $formtosupervisortype = new Mailtype();
        $formtohrtype = new Mailtype();

        $createdtype->setName('usercreated');
        $weekbeforedeadlinetype->setName('weekbeforedeadline');
        $newcycletype->setName('newcycle');
        $newfeedbacktype->setName('finished');
        $formtosupervisortype->setName('formtosupervisor');
        $formtohrtype->setName('formtohr');

        $manager->persist($createdtype);
        $manager->persist($weekbeforedeadlinetype);
        $manager->persist($newcycletype);
        $manager->persist($newfeedbacktype);
        $manager->persist($formtosupervisortype);
        $manager->persist($formtohrtype);

        $created = new Systemmail();
        $weekbeforedeadline = new Systemmail();
        $newcycle = new Systemmail();
        $newfeedback = new Systemmail();
        $formtosupervisor = new Systemmail();
        $formtohr = new Systemmail();
        
        $created->setName('Account created mail');
        $weekbeforedeadline->setName('Week before deadline mail');
        $newcycle->setName('New cycle ready mail');
        $newfeedback->setName('Cycle finished mail');
        $formtosupervisor->setName('Form sent to supervisor mail');
        $formtohr->setName('Form sent to HR mail');

        $created->setMailtype($createdtype);
        $weekbeforedeadline->setMailtype($weekbeforedeadlinetype);
        $newcycle->setMailtype($newcycletype);
        $newfeedback->setMailtype($newfeedbacktype);
        $formtosupervisor->setMailtype($formtosupervisortype);
        $formtohr->setMailtype($formtohrtype);

        $created->setLanguage($this->getReference('english'));
        $weekbeforedeadline->setLanguage($this->getReference('english'));
        $newcycle->setLanguage($this->getReference('english'));
        $newfeedback->setLanguage($this->getReference('english'));
        $formtosupervisor->setLanguage($this->getReference('english'));
        $formtohr->setLanguage($this->getReference('english'));

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

        $created = new Systemmail();
        $weekbeforedeadline = new Systemmail();
        $newcycle = new Systemmail();
        $newfeedback = new Systemmail();
        $formtosupervisor = new Systemmail();
        $formtohr = new Systemmail();

        $created->setMailtype($createdtype);
        $weekbeforedeadline->setMailtype($weekbeforedeadlinetype);
        $newcycle->setMailtype($newcycletype);
        $newfeedback->setMailtype($newfeedbacktype);
        $formtosupervisor->setMailtype($formtosupervisortype);
        $formtohr->setMailtype($formtohrtype);

        $created->setName('Account aangemaakt mail');
        $weekbeforedeadline->setName('Week voor deadline mail');
        $newcycle->setName('Nieuwe  cyclus beschikbaar mail');
        $newfeedback->setName('Cyclus klaar mail');
        $formtosupervisor->setName('Formulier naar overste gestuurd mail');
        $formtohr->setName('Formulier naar HR gestuurd mail');

        $created->setLanguage($this->getReference('nederlands'));
        $weekbeforedeadline->setLanguage($this->getReference('nederlands'));
        $newcycle->setLanguage($this->getReference('nederlands'));
        $newfeedback->setLanguage($this->getReference('nederlands'));
        $formtosupervisor->setLanguage($this->getReference('nederlands'));
        $formtohr->setLanguage($this->getReference('nederlands'));

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