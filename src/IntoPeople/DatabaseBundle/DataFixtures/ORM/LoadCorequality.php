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
        $nederlands = $this->getReference('nederlands');

        $array = array('Accurate', 'Adaptibility', 'Alert', 'Ambitious', 'Attentive', 'Balanced', 'Bright', 'Carefree', 'Careful', 'Cheerful / Jolly', 'Confident', 'Confronting', 'Concise',
            'Cooperative', 'Corteous', 'Creative', 'Daring', 'Decisiveness', 'Diplomatic', 'Disciplined', 'Easy going', 'Effective', 'Empathy', 'Enthousiast', 'Flexible', 'Friendly', 'Generous',
            'Guts', 'Harmonious', 'Helpful', 'Honest', 'Humorous', 'Imaginative', 'Improvise', 'Independant', 'Loose', 'Loyal', 'Modest', 'Motivated', 'Normal', 'Objective', 'Open', 'Optimistic',
            'Organised', 'Patient', 'Pragmatic', 'Present', 'Pro-active', 'Realist', 'Relaxed', 'Reserved', 'Responsible', 'Sensitive', 'Serious', 'Sharp', 'Sparse',
            'Spontanious', 'Stylish', 'Sympathy', 'Tact', 'Tolerant', 'Unconditional');

        foreach ($array as $quality) {

            $core = new Corequality();
            $core->setCoreQuality($quality);
            $core->setLanguage($english);
            $core->setIsStandard(true);

            $manager->persist($core);

        }

        $kernkwaliteiten = array('Aanpassingsvermogen', 'Aanwezig', 'Alert', 'Behulpzaam', 'Bescheiden', 'Betrouwbaar', 'Confronterend', 'Creatief', 'Daadkrachtig', 'Degelijk', 'Diplomatisch',
            'Doeltreffend', 'Enthousiast', 'Evenwichtig', 'Flexibel', 'Gedisciplineerd', 'Gedreven', 'Geduld', 'Gereserveerd', 'Gevoelig', 'Gewoon', 'Harmonieus', 'Hoffelijk', 'Humor', 'Ijver',
            'Improvisatie', 'Initiatief', 'Inlevingsvermogen', 'Lef', 'Los', 'Medelevend', 'Nuchter', 'Onbaatzuchtig', 'Ongedwongen', 'Open', 'Openhartig', 'Optimisme', 'Ordelijk', 'Pragmatisme',
            'Realisme', 'Relaxed', 'Samenhorigheid', 'Scherpzinnigheid', 'Serieus', 'Spaarzaam', 'Spontaan', 'Stijl', 'Tact', 'Verdraagzaam', 'Voorzichtig', 'Vriendelijk', 'Vrijgevig', 'Vrolijk',
            'Zakelijk', 'Zelfredzaam', 'Zelfstandig', 'Zelfzeker', 'Zorgeloos', 'Zorgvuldig', 'Zorgzaam');

        foreach ($kernkwaliteiten as $kwaliteit) {

            $core = new Corequality();
            $core->setCoreQuality($kwaliteit);
            $core->setLanguage($nederlands);
            $core->setIsStandard(true);

            $manager->persist($core);

        }

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