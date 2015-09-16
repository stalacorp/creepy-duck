<?php
/**
 * Created by PhpStorm.
 * User: Matthias
 * Date: 12/09/2015
 * Time: 16:25
 */

namespace IntoPeople\DatabaseBundle\Twig;

use Doctrine\ORM\EntityManager;

class uploadExtension extends \Twig_Extension
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getGlobals()
    {


        return array(
            "uploads" => $this->em->getRepository('IntoPeopleDatabaseBundle:Upload')->findAll(),
        );
    }

    public function getName()
    {
        return 'IntoPeopleDatabaseBundle:UploadExtension';
    }
}