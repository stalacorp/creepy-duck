<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadGeneralcyclestatus.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Generalcyclestatus;



class LoadGeneralcyclestatus implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $active = new Generalcyclestatus();
        $finished = new Generalcyclestatus();
        $inactive = new Generalcyclestatus();
        
        $active->setName('Active');       
        $finished->setName('Finished');
        $inactive->setName('Inactive');
        
        $active->setId(1);
        $finished->setId(2);
        $inactive->setId(3);
        
        $metadata = $manager->getClassMetaData(get_class($active));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        
        $metadata = $manager->getClassMetaData(get_class($finished));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        
        $metadata = $manager->getClassMetaData(get_class($inactive));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $manager->persist($active);
        $manager->persist($finished);
        $manager->persist($inactive);
        $manager->flush();
    }
}