<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadFormstatus.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Formstatus;


class LoadFormstatus implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $available = new Formstatus();
        $inprogress = new Formstatus();
        $sentsup = new Formstatus();
        $sentbacksup = new Formstatus();
        $senthr = new Formstatus();
        $onhold = new Formstatus();
        $sentbackhr = new Formstatus();
        $finished = new Formstatus();
        $unavailable = new Formstatus();
        
        $available->setId(1);
        $inprogress->setId(2);
        $sentsup->setId(3);
        $sentbacksup->setId(4);
        $senthr->setId(5);
        $onhold->setId(6);
        $sentbackhr->setId(7);
        $finished->setId(8);
        $unavailable->setId(9);
        
        $available->setName('Available');       
        $inprogress->setName('In Progress');        
        $sentsup->setName('Sent to supervisor');       
        $sentbacksup->setName('Sent back by supervisor');       
        $senthr->setName('Sent to HR');        
        $onhold->setName('On hold');        
        $sentbackhr->setName('Sent back by HR');
        $finished->setName('Finished');
        $unavailable->setName('Unavailable');
        
        $manager->persist($available);
        $manager->persist($inprogress);
        $manager->persist($sentsup);
        $manager->persist($sentbacksup);
        $manager->persist($senthr);
        $manager->persist($onhold);
        $manager->persist($sentbackhr);
        $manager->persist($finished);
        $manager->persist($unavailable);
       
        $manager->flush();
    }
}