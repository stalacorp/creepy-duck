<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadTemplateversion.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use IntoPeople\DatabaseBundle\Entity\Templateversion;



class LoadTemplateversion extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $templateversion = new Templateversion();

        $dt = new \DateTime();
        $templateversion->setDate($dt);
        $templateversion->setVersion('Templates2015');

        $manager->persist($templateversion);
        $manager->flush();

        $this->addReference('Templates2015', $templateversion);

    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}