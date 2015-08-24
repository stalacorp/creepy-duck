<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadLanguage.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Language;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;



class LoadLanguage extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {       
        $english = new Language();
        $nederlands = new Language();
         
        $english->setName('English');
        $nederlands->setName('Nederlands');
        
        $english->setId(1);
        $nederlands->setId(2);
        
        $metadata = $manager->getClassMetaData(get_class($english));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        
        $metadata = $manager->getClassMetaData(get_class($nederlands));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $manager->persist($english);
        $manager->persist($nederlands);
        $manager->flush();
        
        $this->addReference('english', $english);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
    
}