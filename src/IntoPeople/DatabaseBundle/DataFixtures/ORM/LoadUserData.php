<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadUserData.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Person;


class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();

        $userAdmin->setUsername('queenie');
        $userAdmin->setEmail('queenie.dirkx@intopeople.be');
        $userAdmin->setPlainPassword('admin');
        # $userAdmin->setTitle('Mrs');
        $userAdmin->setFirstname('Queenie');
        $userAdmin->setLastname('Dirkx');
        $userAdmin->addRole('ROLE_SUPER_ADMIN');
        $userAdmin->addRole('ROLE_ADMIN');
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}