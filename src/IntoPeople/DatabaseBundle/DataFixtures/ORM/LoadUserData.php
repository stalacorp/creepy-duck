<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadUserData.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('into_people_database.user_manager');

        // Create user and set details
        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@test.com');
        $user->setPlainPassword('admin');
        $user->addRole('ROLE_USER');
        $user->setEnabled(true);

        //$user->setRoles(array('ROLE_ADMIN'));

        // Update the user
        $userManager->updateUser($user, true);


    }
}