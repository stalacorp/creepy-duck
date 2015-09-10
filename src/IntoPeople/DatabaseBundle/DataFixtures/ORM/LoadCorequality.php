<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadCorequality.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Cdptemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use IntoPeople\DatabaseBundle\Entity\Corequality;


class LoadCorequality extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $english = $this->getReference('english');

        $accurate = new Corequality();
        $accurate->setCoreQuality("Accurate");
        $accurate->setLanguage($english);

        $adaptibility = new Corequality();
        $adaptibility->setCoreQuality("Adaptibility");
        $adaptibility->setLanguage($english);

        $alert = new Corequality();
        $alert->setCoreQuality("Alert");
        $alert->setLanguage($english);

        $ambitious = new Corequality();
        $ambitious->setCoreQuality("Ambitious");
        $ambitious->setLanguage($english);

        $attentive = new Corequality();
        $attentive->setCoreQuality("Attentive");
        $attentive->setLanguage($english);

        $balanced = new Corequality();
        $balanced->setCoreQuality("Balanced");
        $balanced->setLanguage($english);


        $manager->persist($accurate);
        $manager->persist($adaptibility);
        $manager->persist($alert);
        $manager->persist($ambitious);
        $manager->persist($attentive);
        $manager->persist($balanced);
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}