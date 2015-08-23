<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User', 'default');
        $entities = $repository->findAll();

        return $this->render('IntoPeopleDatabaseBundle:Default:index.html.twig', array('entities' => $entities));
    }
}
