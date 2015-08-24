<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadOrganizationstatus.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Organizationstatus;



class LoadOrganizationstatus implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {       
        $active = new Organizationstatus();
        $inactive = new Organizationstatus();
         
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
    }
}