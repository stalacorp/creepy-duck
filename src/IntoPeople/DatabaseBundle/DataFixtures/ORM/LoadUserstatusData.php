<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadUserstatusData.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Userstatus;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;


class LoadUserstatusData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $active = new Userstatus();
        $inactive = new Userstatus();

        $active->setName('Active');
        $inactive->setName('Inactive');

        $active->setId(1);
        $inactive->setId(2);

        $metadata = $manager->getClassMetaData(get_class($active));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $metadata = $manager->getClassMetaData(get_class($inactive));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $manager->persist($active);
        $manager->persist($inactive);
        $manager->flush();

        $this->addReference('active', $active);
        $this->addReference('inactive', $inactive);

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }
}