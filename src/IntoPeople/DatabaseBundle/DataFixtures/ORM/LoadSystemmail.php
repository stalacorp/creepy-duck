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
        $supervisortoemployeetype = new Mailtype();
        $hrtoemployeetype = new Mailtype();
        $remindermailtype = new Mailtype();

        $createdtype->setIsActive(true);
        $weekbeforedeadlinetype->setIsActive(true);
        $newcycletype->setIsActive(true);
        $newfeedbacktype->setIsActive(true);
        $formtosupervisortype->setIsActive(true);
        $formtohrtype->setIsActive(true);
        $supervisortoemployeetype->setIsActive(true);
        $hrtoemployeetype->setIsActive(true);
        $remindermailtype->setIsActive(true);

        $weekbeforedeadlinetype->setReminderdays(7);

        $createdtype->setName('usercreated');
        $weekbeforedeadlinetype->setName('weekbeforedeadline');
        $newcycletype->setName('newcycle');
        $newfeedbacktype->setName('finished');
        $formtosupervisortype->setName('formtosupervisor');
        $formtohrtype->setName('formtohr');
        $supervisortoemployeetype->setName('supervisortoemployee');
        $hrtoemployeetype->setName('hrtoemployee');
        $remindermailtype->setName('remindermail');

        $manager->persist($createdtype);
        $manager->persist($weekbeforedeadlinetype);
        $manager->persist($newcycletype);
        $manager->persist($newfeedbacktype);
        $manager->persist($formtosupervisortype);
        $manager->persist($formtohrtype);
        $manager->persist($supervisortoemployeetype);
        $manager->persist($hrtoemployeetype);
        $manager->persist($remindermailtype);

        $created = new Systemmail();
        $weekbeforedeadline = new Systemmail();
        $newcycle = new Systemmail();
        $newfeedback = new Systemmail();
        $formtosupervisor = new Systemmail();
        $formtohr = new Systemmail();
        $supervisortoemployee = new Systemmail();
        $hrtoemployee = new Systemmail();
        $remindermail = new Systemmail();
        
        $created->setName('Account created mail');
        $weekbeforedeadline->setName('X days before deadline mail');
        $newcycle->setName('New cycle ready mail');
        $newfeedback->setName('Form approved mail');
        $formtosupervisor->setName('Form sent to supervisor mail');
        $formtohr->setName('Form sent to HR mail');
        $supervisortoemployee->setName('Form sent back from supervisor to employee mail');
        $hrtoemployee->setName('Form sent back from HR to employee mail');
        $remindermail->setName('Reminder mail');

        $created->setSubject('Account created mail');
        $weekbeforedeadline->setSubject('X days before deadline mail');
        $newcycle->setSubject('New cycle ready mail');
        $newfeedback->setSubject('Cycle finished mail');
        $formtosupervisor->setSubject('Form sent to supervisor mail');
        $formtohr->setSubject('Form sent to HR mail');
        $supervisortoemployee->setSubject('Form sent back from supervisor to employee mail');
        $hrtoemployee->setSubject('Form sent back from HR to employee mail');
        $remindermail->setSubject('Reminder mail');

        $created->setBody('$url');
        $weekbeforedeadline->setBody('$url');
        $newcycle->setBody('$url');
        $newfeedback->setBody('$url');
        $formtosupervisor->setBody('$url');
        $formtohr->setBody('$url');
        $supervisortoemployee->setBody('$url');
        $hrtoemployee->setBody('$url');
        $remindermail->setBody('$url');

        $created->setSender('example@mail.com');
        $weekbeforedeadline->setSender('example@mail.com');
        $newcycle->setSender('example@mail.com');
        $newfeedback->setSender('example@mail.com');
        $formtosupervisor->setSender('example@mail.com');
        $formtohr->setSender('example@mail.com');
        $supervisortoemployee->setSender('example@mail.com');
        $hrtoemployee->setSender('example@mail.com');
        $remindermail->setSender('example@mail.com');

        $created->setMailtype($createdtype);
        $weekbeforedeadline->setMailtype($weekbeforedeadlinetype);
        $newcycle->setMailtype($newcycletype);
        $newfeedback->setMailtype($newfeedbacktype);
        $formtosupervisor->setMailtype($formtosupervisortype);
        $formtohr->setMailtype($formtohrtype);
        $supervisortoemployee->setMailtype($supervisortoemployeetype);
        $hrtoemployee->setMailtype($hrtoemployeetype);
        $remindermail->setMailtype($remindermailtype);
        
        $english = $this->getReference('english');

        $created->setLanguage($english);
        $weekbeforedeadline->setLanguage($english);
        $newcycle->setLanguage($english);
        $newfeedback->setLanguage($english);
        $formtosupervisor->setLanguage($english);
        $formtohr->setLanguage($english);
        $supervisortoemployee->setLanguage($english);
        $hrtoemployee->setLanguage($english);
        $remindermail->setLanguage($english);

        $manager->persist($created);
        $manager->persist($weekbeforedeadline);
        $manager->persist($newcycle);
        $manager->persist($newfeedback);
        $manager->persist($formtosupervisor);
        $manager->persist($formtohr);
        $manager->persist($supervisortoemployee);
        $manager->persist($hrtoemployee);
        $manager->persist($remindermail);

        $created = new Systemmail();
        $weekbeforedeadline = new Systemmail();
        $newcycle = new Systemmail();
        $newfeedback = new Systemmail();
        $formtosupervisor = new Systemmail();
        $formtohr = new Systemmail();
        $supervisortoemployee = new Systemmail();
        $hrtoemployee = new Systemmail();
        $remindermail = new Systemmail();

        $created->setMailtype($createdtype);
        $weekbeforedeadline->setMailtype($weekbeforedeadlinetype);
        $newcycle->setMailtype($newcycletype);
        $newfeedback->setMailtype($newfeedbacktype);
        $formtosupervisor->setMailtype($formtosupervisortype);
        $formtohr->setMailtype($formtohrtype);
        $supervisortoemployee->setMailtype($supervisortoemployeetype);
        $hrtoemployee->setMailtype($hrtoemployeetype);
        $remindermail->setMailtype($remindermailtype);

        $created->setName('Account aangemaakt mail');
        $weekbeforedeadline->setName('X dagen voor deadline mail');
        $newcycle->setName('Nieuwe  cyclus beschikbaar mail');
        $newfeedback->setName('Formulier goedgekeurd mail');
        $formtosupervisor->setName('Formulier naar overste gestuurd mail');
        $formtohr->setName('Formulier naar HR gestuurd mail');
        $supervisortoemployee->setName('Formulier van overste terug naar werknemer gestuurd mail');
        $hrtoemployee->setName('Formulier van HR terug naar werknemer gestuurd mail');
        $remindermail->setName('Herinneringsmail');

        $nederlands = $this->getReference('nederlands');
        $created->setLanguage($nederlands);
        $weekbeforedeadline->setLanguage($nederlands);
        $newcycle->setLanguage($nederlands);
        $newfeedback->setLanguage($nederlands);
        $formtosupervisor->setLanguage($nederlands);
        $formtohr->setLanguage($nederlands);
        $supervisortoemployee->setLanguage($nederlands);
        $hrtoemployee->setLanguage($nederlands);
        $remindermail->setLanguage($nederlands);


        $created->setSubject('Account aangemaakt mail');
        $weekbeforedeadline->setSubject('X dagen voor deadline mail');
        $newcycle->setSubject('Nieuwe  cyclus beschikbaar mail');
        $newfeedback->setSubject('Cyclus klaar mail');
        $formtosupervisor->setSubject('Formulier naar overste gestuurd mail');
        $formtohr->setSubject('Formulier naar HR gestuurd mail');
        $supervisortoemployee->setSubject('Formulier van overste terug naar werknemer gestuurd mail');
        $hrtoemployee->setSubject('Formulier van HR terug naar werknemer gestuurd mail');
        $remindermail->setSubject('Herinneringsmail');

        $created->setBody('$url');
        $weekbeforedeadline->setBody('$url');
        $newcycle->setBody('$url');
        $newfeedback->setBody('$url');
        $formtosupervisor->setBody('$url');
        $formtohr->setBody('$url');
        $supervisortoemployee->setBody('$url');
        $hrtoemployee->setBody('$url');
        $remindermail->setBody('$url');

        $created->setSender('example@mail.com');
        $weekbeforedeadline->setSender('example@mail.com');
        $newcycle->setSender('example@mail.com');
        $newfeedback->setSender('example@mail.com');
        $formtosupervisor->setSender('example@mail.com');
        $formtohr->setSender('example@mail.com');
        $supervisortoemployee->setSender('example@mail.com');
        $hrtoemployee->setSender('example@mail.com');
        $remindermail->setSender('example@mail.com');

        $manager->persist($created);
        $manager->persist($weekbeforedeadline);
        $manager->persist($newcycle);
        $manager->persist($newfeedback);
        $manager->persist($formtosupervisor);
        $manager->persist($formtohr);
        $manager->persist($supervisortoemployee);
        $manager->persist($hrtoemployee);
        $manager->persist($remindermail);

        $manager->flush();


    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 7;
    }
}