<?php

// src/IntoPeople/DatabaseBundle/DataFixtures/ORM/LoadCdptemplate.php

namespace IntoPeople\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use IntoPeople\DatabaseBundle\Entity\Cdptemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;



class LoadCdptemplate extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {       
        $cdptemplate = new Cdptemplate();

        $cdptemplate->setMainTitle('Career Development Plan');
        $cdptemplate->setTitle1('Personalia');

        $cdptemplate->setName('Name');
        $cdptemplate->setSupervisor('Supervisor');
        $cdptemplate->setDateDiscussion('Date discussion');
        $cdptemplate->setTeam('Team');
        $cdptemplate->setFunction('Job Title');

        $cdptemplate->setTitle2("Self Assessment");
        $cdptemplate->setTitle2Description("Complete at least three, no more than five items for both strengths and development needs. ");

        $cdptemplate->setTable2Col1("Talents");
        $cdptemplate->setTable2Col2("Pitfall");
        $cdptemplate->setTable2Col3("Challenges");
        $cdptemplate->setTable2Col4("How");
        $cdptemplate->setTable2Col5("Success");
        $cdptemplate->setTable2Col6("Needs");

        $cdptemplate->setTable2Col1Descr("What are you good at?");
        $cdptemplate->setTable2Col2Descr("What is my pitfall?");
        $cdptemplate->setTable2Col3Descr("So what is your challenge?");
        $cdptemplate->setTable2Col4Descr("How are you going to take on this challenge?");
        $cdptemplate->setTable2Col5Descr("How will you know if you succeeded?");
        $cdptemplate->setTable2Col6Descr("What do you need to complete your challenge?");


        $cdptemplate->setTitle3('Development Needs for your Job');
        $cdptemplate->setTitle3Description('Read your Job Description carefully.');

        $cdptemplate->setTable3Col1("What & why");
        $cdptemplate->setTable3Col2("How");
        $cdptemplate->setTable3Col3("Success");
        $cdptemplate->setTable3Col4("Needs");

        $cdptemplate->setTable3Col1Descr("Write down the actions you will take this year to further develop yourself in your job.");
        $cdptemplate->setTable3Col2Descr("How will you do this?");
        $cdptemplate->setTable3Col3Descr("How will you know if you succeeded?");
        $cdptemplate->setTable3Col4Descr("What do you need ( training, knowledge sharing, books, tools, etc. ) ?");

        $cdptemplate->setTable3Title1('Job Specific Tasks and Responsibilities');
        $cdptemplate->setTable3Title2('Job Specific Skills and Competencies');
        $cdptemplate->setTable3Title3('Organization Competencies');

        $cdptemplate->setTitle4("Career Objectives / Staffing Considerations");
        $cdptemplate->setQuestion1("Where do you see yourself in three years?");

        $cdptemplate->setTitle5("Additional Information");
        $cdptemplate->setQuestion2("List any additional information that is relevant to your Career Development Plan (CDP) for the coming year. Such information could include your interest in special assignments, considerations related to work / life balance, etc.");

        $cdptemplate->setSupervisorComment("Supervisor Comments");
        $cdptemplate->setFeedback("Feedback MT");
        $cdptemplate->setSignatureSupervisor("Date & supervisor's Signature");
        $cdptemplate->setSignatureEmployee("Date & Employee's Signature");
        $cdptemplate->setLanguage($this->getReference('english'));

        $cdptemplate->setTemplateversion($this->getReference('Templates2015'));
        
        $dt = new \DateTime();
        $cdptemplate->setDate($dt);

        $cdptemplate->setOrganization($this->getReference('organization'));



        $cdptemplatenl = new Cdptemplate();

        $cdptemplatenl->setMainTitle('Persoonlijk Ontwikkel Plan');
        $cdptemplatenl->setTitle1('Persoonlijke gegevens');

        $cdptemplatenl->setName('Naam');
        $cdptemplatenl->setSupervisor('Leidinggevende');
        $cdptemplatenl->setDateDiscussion('Datum bespreking');
        $cdptemplatenl->setTeam('Team');
        $cdptemplatenl->setFunction('Functie');

        $cdptemplatenl->setTitle2("Moment van zelfreflectie");
        $cdptemplatenl->setTitle2Description("Werk minimum drie maximum vijf van je sterktes en talenten verder uit.");

        $cdptemplatenl->setTable2Col1("Talenten");
        $cdptemplatenl->setTable2Col2("Uitdagingen");
        $cdptemplatenl->setTable2Col3("Valkuilen");
        $cdptemplatenl->setTable2Col4("Hoe");
        $cdptemplatenl->setTable2Col5("Succes");
        $cdptemplatenl->setTable2Col6("Noden");

        $cdptemplatenl->setTable2Col1Descr("Waar ben ik goed in?");
        $cdptemplatenl->setTable2Col2Descr("Wat is mijn uitdaging?");
        $cdptemplatenl->setTable2Col3Descr("Te veel van het goede vormt een valkuil. Wat is die valkuil voor mij en hoe vertaalt zich dit in de praktijk?");
        $cdptemplatenl->setTable2Col4Descr("Hoe ga ik deze uitdaging aan?");
        $cdptemplatenl->setTable2Col5Descr("Hoe weet ik dat ik geslaagd ben in het realiseren van mijn doelstelling?");
        $cdptemplatenl->setTable2Col6Descr("Welke hulp(middelen) heb je hiervoor nodig?");

        $cdptemplatenl->setTitle3('Ontwikkeldoelstellingen voor jouw functie');
        $cdptemplatenl->setTitle3Description('Neem je functiebeschrijving en bijhorende competenties bij de hand voor deze oefening en neem deze aandacht door.');

        $cdptemplatenl->setTable3Col1("Wat en Waarom");
        $cdptemplatenl->setTable3Col2("Hoe");
        $cdptemplatenl->setTable3Col3("Succes");
        $cdptemplatenl->setTable3Col4("Noden");

        $cdptemplatenl->setTable3Col1Descr("Waar moet je nog in groeien en wat ga je extra doen dit jaar?");
        $cdptemplatenl->setTable3Col2Descr("Hoe ga je dit realiseren?");
        $cdptemplatenl->setTable3Col3Descr("Hoe weet je dat je geslaagd zal zijn in je vooropgestelde doel?");
        $cdptemplatenl->setTable3Col4Descr("Welke hulp(middelen) heb je hiervoor nodig?");

        $cdptemplatenl->setTable3Title1('Functiegebonden resultaatsgebieden en verantwoordelijkheden');
        $cdptemplatenl->setTable3Title2('Functiegebonden competenties');
        $cdptemplatenl->setTable3Title3('Bedrijfsspecifieke competenties');

        $cdptemplatenl->setTitle4("Loopbaan objectieven");
        $cdptemplatenl->setQuestion1("Waar zie je jezelf over drie jaren?");

        $cdptemplatenl->setTitle5("Bijkomende informatie");
        $cdptemplatenl->setQuestion2("Beschrijf bijkomende informatie die relevant is voor jouw Persoonlijke Ontwikkeling het komende jaar. Dit kan gaan over gebeurtenissen die impact kunnen hebben op de werk/privé balans, speciale wensen, etc.");

        $cdptemplatenl->setSupervisorComment("Commentaar leidinggevende");
        $cdptemplatenl->setFeedback("Feedback MT");
        $cdptemplatenl->setSignatureSupervisor("Gelezen en goedgekeurd door leidinggevende");
        $cdptemplatenl->setSignatureEmployee("Gelezen en goedgekeurd door medewerker");
        $cdptemplatenl->setLanguage($this->getReference('nederlands'));

        $cdptemplatenl->setTemplateversion($this->getReference('Templates2015'));

        $dt = new \DateTime();
        $cdptemplatenl->setDate($dt);

        $cdptemplatenl->setOrganization($this->getReference('organization'));

        $manager->persist($cdptemplate);
        $manager->persist($cdptemplatenl);
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }
}