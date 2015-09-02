<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $securityContext = $this->container->get('security.context');
        $route = 'myfeedbackcycle';


        if ($securityContext->isGranted('ROLE_SUPERVISOR')){
            $route = 'supervisor_dashboard';
        }

        if ($securityContext->isGranted('ROLE_HR')){
            $route = 'hr_dashboard';
        }

        return $this->redirect($this->generateUrl($route, array('_locale' => $user->getLanguage()->getLocaleabr())));
    }
}
