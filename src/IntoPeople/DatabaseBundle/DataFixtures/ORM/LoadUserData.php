<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadUserData.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;


class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $supervisor = $userManager->createUser();
        $supervisor->setEmail('birtpeeters@hotmail.com');
        $supervisor->setUsername('birtpeeters@hotmail.com');
        $supervisor->setPlainPassword('test');
        $supervisor->setEnabled(true);
        $supervisor->addRole('ROLE_SUPERVISOR');
        $supervisor->setFirstname('jos');
        $supervisor->setLastname('vermeulen');
        $supervisor->setLanguage($this->getReference('english'));
        $supervisor->setUsernameCanonical('birtpeeters@hotmail.com');
        $supervisor->setEmailCanonical('birtpeeters@hotmail.com');

        $userManager->updateUser($supervisor);

        $hr = $userManager->createUser();
        $hr->setEmail('bart_peeters@mail.com');
        $hr->setUsername('bart_peeters@mail.com');
        $hr->setPlainPassword('test');
        $hr->setUsernameCanonical('bart_peeters@mail.com');
        $hr->setEmailCanonical('bart_peeters@mail.com');
        $hr->setEnabled(true);
        $hr->addRole('ROLE_HR');
        $hr->setFirstname('jos');
        $hr->setLastname('vermeulen');
        $hr->setLanguage($this->getReference('english'));
        $userManager->updateUser($hr, true);

        $userManager->updateUser($hr);

        // Create user and set details
        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@test.com');
        $user->setPlainPassword('admin');
        $user->addRole('ROLE_USER');
        $user->setEnabled(true);
        $user->setFirstname('Queenie');
        $user->setLastname('Dirckx');
        $user->setUsernameCanonical('admin');
        $user->setEmailCanonical('admin@test.com');
        $user->setSupervisor($supervisor);

        $userManager->updateUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }
}