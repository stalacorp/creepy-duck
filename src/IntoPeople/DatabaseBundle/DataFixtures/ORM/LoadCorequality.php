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
        $accurate->setIsStandard(true);

        $adaptibility = new Corequality();
        $adaptibility->setCoreQuality("Adaptibility");
        $adaptibility->setLanguage($english);
        $adaptibility->setIsStandard(true);

        $alert = new Corequality();
        $alert->setCoreQuality("Alert");
        $alert->setLanguage($english);
        $alert->setIsStandard(true);

        $ambitious = new Corequality();
        $ambitious->setCoreQuality("Ambitious");
        $ambitious->setLanguage($english);
        $ambitious->setIsStandard(true);

        $attentive = new Corequality();
        $attentive->setCoreQuality("Attentive");
        $attentive->setLanguage($english);
        $attentive->setIsStandard(true);

        $balanced = new Corequality();
        $balanced->setCoreQuality("Balanced");
        $balanced->setLanguage($english);
        $balanced->setIsStandard(true);


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