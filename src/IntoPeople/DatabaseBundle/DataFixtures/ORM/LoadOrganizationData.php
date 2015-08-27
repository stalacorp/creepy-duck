<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadOrganizationData.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Organization;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadOrganizationData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $organization = new Organization();

        $organization->setId(1);
        $organization->setName('Samsung');

        $metadata = $manager->getClassMetaData(get_class($organization));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $manager->persist($organization);
        $manager->flush();

        $this->addReference('organization', $organization);

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}