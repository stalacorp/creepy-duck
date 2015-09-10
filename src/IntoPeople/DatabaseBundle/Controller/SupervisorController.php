<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;
use IntoPeople\DatabaseBundle\Form\FeedbackcycleType;
use IntoPeople\DatabaseBundle\Entity\Developmentneeds;
use IntoPeople\DatabaseBundle\Entity\Cdp;
use IntoPeople\DatabaseBundle\Entity\Midyear;
use IntoPeople\DatabaseBundle\Entity\Endyear;
use IntoPeople\DatabaseBundle\Form\CommentType;
use IntoPeople\DatabaseBundle\Form\MidyearCommentType;
use IntoPeople\DatabaseBundle\Form\EndyearCommentType;
use IntoPeople\DatabaseBundle\Entity\Cdphistory;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Supervisor controller.
 */
class SupervisorController extends Controller
{

    /**
     * Lists all feedbackcycles of supervisors employees.
     */
    public function indexAction()
    {
       
        $user = $this->getUser();

        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle');
        
        $query = $repository->createQueryBuilder('f')
            ->addSelect('g')
            ->addSelect('u')
            ->addSelect('c')
            ->addSelect('m')
            ->addSelect('e')
            ->addSelect('cf')
            ->addSelect('mf')
            ->addSelect('ef')
            ->join('f.generalcycle', 'g')
            ->join('f.user','u')
            ->join('f.cdp','c')
            ->join('f.midyear','m')
            ->join('f.endyear','e')
            ->join('c.formstatus','cf')
            ->join('m.formstatus','mf')
            ->join('e.formstatus','ef')
            ->andWhere('g.generalcyclestatus = :generalcyclestatus')
            ->setParameter('generalcyclestatus', 1 )
            ->orderby('u.firstname')
            ->getQuery();
        
        $entities = $query->getResult();
        
        return $this->render('IntoPeopleDatabaseBundle:Supervisor:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Displays a form to edit an existing Cdp entity.
     */
    public function addCommentAction($id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }

        if($this->getUser() != $entity->getSupervisor()){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }

        // CAN ONLY ADD COMMENT WHEN STATUS = 3
        //

        if ($entity->getFormstatus()->getId() == 3 ) {

            $form = $this->createEditForm($entity);
            $user = $this->getUser();

            return $this->render('IntoPeopleDatabaseBundle:Supervisor:feedback.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
        }

        return $this->redirect($this->generateUrl('cdp_show', array(
            'id' => $entity->getId()
        )));
    }
    
    /**
     * Creates a form to edit a cdp entity.
     *
     * @param Cdp $entity
     *            The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Cdp $entity)
    {
        $locale = $this->get('request')->getLocale();

        $form = $this->createForm(new CommentType($locale), $entity, array(
            'action' => $this->generateUrl('supervisor_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form
        ->add('save', 'submit', array('label' => 'Save'))
        ->add('approve', 'submit', array('label' => 'Approve'))
        ->add('disapprove', 'submit', array('label' => 'Disapprove'));
        return $form;
    }
  
    /**
     * Updates a Cdp entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);
    
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }
    
        $form = $this->createEditForm($entity);
        $form->handleRequest($request);      
    
        if ($form->isValid()) {
            
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
            
            if ($form->get('approve')->isClicked()) {

                $hrs = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User')->createQueryBuilder('u')
                    ->where('u.roles like :role')
                    ->setParameter('role', '%ROLE_HR%')
                    ->getQuery()->getResult();

                $formstatus = $repository->find(5);

                foreach ($hrs as $hr) {

                    $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                        ->join('s.mailtype', 'm')
                        ->where('s.language = :id')
                        ->andWhere('m.name = :name')
                        ->setParameter('id', $hr->getLanguage())
                        ->setParameter('name', 'formtohr')
                        ->getQuery();

                    $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                    if ($systemmail->getMailtype()->getIsActive()) {
                        $message = \Swift_Message::newInstance()
                            ->setSubject($systemmail->getSubject())
                            ->setFrom($systemmail->getSender())
                            ->setTo($hr->getEmail())
                            ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('cdp_edit', array('id' => $entity->getId())), $systemmail->getBody()));

                        $this->get('mailer')->send($message);
                    }
                }
                $this->addFlash(
                    'success',
                    'You\'ve succesfully approved the CDP!'
                );
                                              
            } elseif ($form->get('disapprove')->isClicked()) {

                $formstatus = $repository->find(4);
                $user = $entity->getFeedbackcycle->getUser();
                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'supervisortoemployee')
                    ->getQuery();

                $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                if ($systemmail->getMailtype()->getIsActive()) {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($systemmail->getSubject())
                        ->setFrom($systemmail->getSender())
                        ->setTo($user->getEmail())
                        ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('midyear_edit', array('id' => $entity->getId())), $systemmail->getBody()));

                    $this->get('mailer')->send($message);
                }
                
                $this->addFlash(
                    'success',
                    'You\'ve succesfully disapproved the CDP!'
                );
                
            } elseif ($form->get('save')->isClicked()) {

                $formstatus = $repository->find(3);
                
                $this->addFlash(
                    'success',
                    'You saved your progress!'
                );
                
            }                     
    
            $entity->setFormstatus($formstatus);
                   
            $em->flush();
    
            return $this->redirect($this->generateUrl('supervisor', array(
                
            )));
        }

        $errors = $form->getErrorsAsString();

        dump($errors);

        return $this->render('IntoPeopleDatabaseBundle:Cdp:show.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Displays a form to edit an existing Midyear entity.
     */
    public function addMidyearCommentAction($id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyear')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Midyear entity.');
        }

        if($this->getUser() != $entity->getSupervisor()){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }

        // CAN ONLY ADD COMMENT WHEN STATUS = 3
        //

        if ($entity->getFormstatus()->getId() == 3 ) {

            $form = $this->createMidyearEditForm($entity);
            $user = $this->getUser();

            return $this->render('IntoPeopleDatabaseBundle:Supervisor:feedbackMidyear.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
        }

        return $this->redirect($this->generateUrl('midyear_show', array(
            'id' => $entity->getId()
        )));
    }
    
    /**
     * Creates a form to edit a midyear entity.
     *
     * @param Midyear $entity
     *            The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createMidyearEditForm(Midyear $entity)
    {
        $form = $this->createForm(new MidyearCommentType(), $entity, array(
            'action' => $this->generateUrl('supervisor_updateMidyear', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form
        ->add('save', 'submit', array('label' => 'Save'))
        ->add('approve', 'submit', array('label' => 'Approve'))
        ->add('disapprove', 'submit', array('label' => 'Disapprove'));
        return $form;
    }
    
    /**
     * Updates a midyear entity.
     */
    public function updateMidyearAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyear')->find($id);
    
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Midyear entity.');
        }
    
        $form = $this->createMidyearEditForm($entity);
        $form->handleRequest($request);
    
        if ($form->isValid()) {
    
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
            
            if ($form->get('approve')->isClicked()) {
                
                $formstatus = $repository->find(5);
                
                $this->addFlash(
                    'success',
                    'You\'ve succesfully approved the CDP!'
                );
                                              
            } elseif ($form->get('disapprove')->isClicked()) {

                $user = $entity->getFeedbackcycle->getUser();
                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'supervisortoemployee')
                    ->getQuery();

                $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                if ($systemmail->getMailtype()->getIsActive()) {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($systemmail->getSubject())
                        ->setFrom($systemmail->getSender())
                        ->setTo($user->getEmail())
                        ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('midyear_edit', array('id' => $entity->getId())), $systemmail->getBody()));

                    $this->get('mailer')->send($message);
                }

                $formstatus = $repository->find(4);
                
                $this->addFlash(
                    'success',
                    'You\'ve succesfully disapproved the CDP!'
                );
                
            } elseif ($form->get('save')->isClicked()) {

                $formstatus = $repository->find(3);
                
                $this->addFlash(
                    'success',
                    'You saved your progress!'
                );
                
            }                      
    
            $entity->setFormstatus($formstatus);
    
            $em->flush();
    
            return $this->redirect($this->generateUrl('supervisor', array(
                'id' => $entity->getId()
            )));
        }
    
        return $this->render('IntoPeopleDatabaseBundle:Midyear:show.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Displays a form to edit an existing Yearend entity.
     */
    public function addEndyearCommentAction($id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyear')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Endyear entity.');
        }

        if($this->getUser() != $entity->getSupervisor()){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }
        // CAN ONLY ADD COMMENT WHEN STATUS = 3
        //

        if ($entity->getFormstatus()->getId() == 3 ) {

            $form = $this->createEndyearEditForm($entity);
            $user = $this->getUser();

            return $this->render('IntoPeopleDatabaseBundle:Supervisor:feedbackEndyear.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
        }

        return $this->redirect($this->generateUrl('endyear_show', array(
            'id' => $entity->getId()
        )));
    }
    
    /**
     * Creates a form to edit a Endyear entity.
     *
     * @param Endyear $entity
     *            The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEndyearEditForm(Endyear $entity)
    {
        $form = $this->createForm(new EndyearCommentType(), $entity, array(
            'action' => $this->generateUrl('supervisor_updateEndyear', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form
        ->add('save', 'submit', array('label' => 'Save'))
        ->add('approve', 'submit', array('label' => 'Approve'))
        ->add('disapprove', 'submit', array('label' => 'Disapprove'));
        return $form;
    }
    
    /**
     * Updates a Endyear entity.
     */
    public function updateEndyearAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyear')->find($id);
    
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Endyear entity.');
        }
    
        $form = $this->createEndyearEditForm($entity);
        $form->handleRequest($request);
    
        if ($form->isValid()) {
    
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
            
        if ($form->get('approve')->isClicked()) {
                
                $formstatus = $repository->find(5);
                
                $this->addFlash(
                    'success',
                    'You\'ve succesfully approved the Year End!'
                );
                                              
            } elseif ($form->get('disapprove')->isClicked()) {

                $user = $entity->getFeedbackcycle->getUser();
                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'supervisortoemployee')
                    ->getQuery();

                $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                if ($systemmail->getMailtype()->getIsActive()) {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($systemmail->getSubject())
                        ->setFrom($systemmail->getSender())
                        ->setTo($user->getEmail())
                        ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('endyear_edit', array('id' => $entity->getId())), $systemmail->getBody()));

                    $this->get('mailer')->send($message);
                }

                $formstatus = $repository->find(4);
                
                $this->addFlash(
                    'success',
                    'You\'ve succesfully disapproved the Year End!'
                );
                
            } elseif ($form->get('save')->isClicked()) {

                $formstatus = $repository->find(3);
                
                $this->addFlash(
                    'success',
                    'You saved your progress!'
                );
                
            }                 
    
            $entity->setFormstatus($formstatus);
    
            $em->flush();
    
            return $this->redirect($this->generateUrl('supervisor', array(
                'id' => $entity->getId()
            )));
        }
    
        return $this->render('IntoPeopleDatabaseBundle:Endyear:show.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    public function dashboardAction(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('generalcycle', 'entity', array(
                'class' => 'IntoPeopleDatabaseBundle:Generalcycle',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.year', 'ASC');
                },
            ))
            ->add('cycle', 'choice', array(
                'choices'  => array('cdp' => 'Cdp')))
            ->getForm();



        return $this->render('IntoPeopleDatabaseBundle:Supervisor:dashboard.html.twig', array(
            'form' => $form->createView(),
        ));



    }

    public function getcyclesAction($generalcycleid, $cycle){

        $em = $this->getDoctrine()->getManager();
        $feedbackcycles = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->findByGeneralcycle($generalcycleid);
        $supervisor = $this->getUser();

        $entities = array();

        foreach ($feedbackcycles as $feedbackcycle){
            if ($cycle == "cdp"){
                $chosencycle = $feedbackcycle->getCdp();
            }else if ($cycle == "midyear"){
                $chosencycle = $feedbackcycle->getMidyear();
            }else if($cycle == "endyear"){
                $chosencycle = $feedbackcycle->getEndyear();
            }
            if ($chosencycle->getSupervisor() == $supervisor){
                array_push($entities, $chosencycle);
            }
        }


        return $this->render('IntoPeopleDatabaseBundle:HR:getcyclesview.html.twig', array(
            'entities' => $entities,
            'cycle' => $cycle,
        ));
    }

    public function getformstatuscountAction($generalcycleid, $cycle){


        $em = $this->getDoctrine()->getManager();
        $feedbackcycles = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->findByGeneralcycle($generalcycleid);
        $supervisor = $this->getUser();

        $formcounts = array();

        foreach ($feedbackcycles as $feedbackcycle){
            if ($cycle == "cdp"){
                $chosencycle = $feedbackcycle->getCdp();
            }else if ($cycle == "midyear"){
                $chosencycle = $feedbackcycle->getMidyear();
            }else if($cycle == "endyear"){
                $chosencycle = $feedbackcycle->getEndyear();
            }
            if ($chosencycle->getSupervisor() == $supervisor) {
                array_push($formcounts, $chosencycle->getFormstatus()->getId());
            }
        }

        $formstatuses = $em->getRepository('IntoPeopleDatabaseBundle:Formstatus')->findAll();

        $counts = array_count_values($formcounts);
        $countsbystatus = array();

        foreach ($formstatuses as $formstatus){
            $object = new \stdClass();
            $object->name = $this->get('translator')->trans($formstatus->getName());
            if (array_key_exists($formstatus->getId(), $counts)){
                $object->count = $counts[$formstatus->getId()];
            }else {
                $object->count = 0;
            }

            array_push($countsbystatus, $object);
        }

        return new JsonResponse($countsbystatus);
    }

    public function getformsAction($generalcycleid){
        $em = $this->getDoctrine()->getManager();
        $generalcycle = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->find($generalcycleid);
        $generalcycledates = array();

        $request = $this->get('request');
        $locale = $request->getLocale();
        $format = "m/d/Y";

        if ($locale == "nl"){
            $format = "d-m-Y";
        }
        if ($generalcycle->getStartdatecdp() != null) {
            array_push($generalcycledates, $generalcycle->getStartdatecdp()->format($format) . ' -- ' . $generalcycle->getEnddatecdp()->format($format));

            if ($generalcycle->getStartdatemidyear() != null) {
                array_push($generalcycledates, $generalcycle->getStartdatemidyear()->format($format) . ' -- ' . $generalcycle->getEnddatemidyear()->format($format));
            } else {
                array_push($generalcycledates, 'empty');
            }

            array_push($generalcycledates, $generalcycle->getStartdateyearend()->format($format) . ' -- ' . $generalcycle->getEnddateyearend()->format($format));
        }

        return new JsonResponse($generalcycledates);

    }

    public function pdfAction($cycle, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $chosencycleids = json_decode($request->get('ids'));

        $query = $em->getRepository('IntoPeopleDatabaseBundle:' . ucfirst($cycle))->createQueryBuilder('c')
            ->where('c.id IN (:ids)')
            ->andWhere('c.supervisor = :supervisor')
            ->setParameter('ids', $chosencycleids)
            ->setParameter('supervisor', $this->getUser())
            ->getQuery();

        $cycles = $query->getResult();

        $facade = $this->get('ps_pdf.facade');
        $response = new Response();
        $this->render('IntoPeopleDatabaseBundle:HR:' . $cycle . '.pdf.twig', array("entities" => $cycles), $response);

        $xml = $response->getContent();

        $content = $facade->render($xml);

        return new Response($content, 200, array('content-type' => 'application/pdf'));


    }
}

