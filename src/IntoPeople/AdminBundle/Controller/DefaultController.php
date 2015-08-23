<?php

namespace IntoPeople\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IntoPeopleAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
