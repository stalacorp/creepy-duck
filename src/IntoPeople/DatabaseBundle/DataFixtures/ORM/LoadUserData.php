<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadUserData.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Jobtitle;
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

        $java = new Jobtitle();
        $php = new Jobtitle();
        $sql = new Jobtitle();

        $java->setName('Java Expert');
        $php->setName('PHP Expert');
        $sql->setName('Sql Expert');

        $manager->persist($java);
        $manager->persist($php);
        $manager->persist($sql);

        $userManager = $this->container->get('into_people_database.user_manager');
        $organization = $this->getReference('organization');
        $active = $this->getReference('active');

        // Create user and set details
        $user = $userManager->createUser();
        $user->setUsername('queenie.dirkx@intopeople.be');
        $user->setEmail('queenie.dirkx@intopeople.be');
        $user->setPlainPassword('admin');
        $user->addRole('ROLE_USER');
        $user->addRole('ROLE_HR');
        $user->addRole('ROLE_SUPERVISOR');
        $user->addRole('ROLE_ADMIN');
        $user->setEnabled(true);
        $user->setFirstname('Queenie');
        $user->setLastname('Dirckx');
        $user->setLanguage($this->getReference('english'));
        $user->setOrganization($organization);
        $user->setUsernameCanonical('queenie.dirkx@intopeople.be');
        $user->setEmailCanonical('queenie.dirkx@intopeople.be');
        $user->setUserstatus($active);

        $userManager->updateUser($user);

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 8;
    }
}