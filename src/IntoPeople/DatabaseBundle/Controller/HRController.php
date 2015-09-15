<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Cdp;
use IntoPeople\DatabaseBundle\Form\CdpFeedbackType;
use IntoPeople\DatabaseBundle\Form\MidyearFeedbackType;
use IntoPeople\DatabaseBundle\Entity\Midyear;
use IntoPeople\DatabaseBundle\Entity\Endyear;
use IntoPeople\DatabaseBundle\Form\EndyearFeedbackType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\File;

/**
 * Supervisor controller.
 */
class HRController extends Controller
{

    /**
     * Displays a form to edit an existing Cdp entity.
     */
    public function addFeedbackAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }

        // CAN ONLY ADD FEEDBACK WHEN STATUS = 5
        //

        if ($entity->getFormstatus()->getId() == 5 || $entity->getFormstatus()->getId() == 6) {

            $form = $this->createEditForm($entity);
            $user = $this->getUser();

            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');

            $query = $repository->createQueryBuilder('c')
                ->where('c.templateversion = :cdptemplateversion')
                ->andWhere('c.language = :language')
                ->setParameter('cdptemplateversion', $entity->getTemplateversion())
                ->setParameter('language', $user->getLanguage())
                ->getQuery();

            $template = $query->setMaxResults(1)->getOneOrNullResult();

            return $this->render('IntoPeopleDatabaseBundle:HR:feedback.html.twig', array(
                'entity' => $entity,
                'template' => $template,
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
        $form = $this->createForm(new CdpFeedbackType(), $entity, array(
            'action' => $this->generateUrl('hr_update', array(
                'id' => $entity->getId()
            )),
            'method' => 'PUT'
        ));

        $form->add('save', 'submit', array(
            'label' => 'Save'
        ))
            ->add('approve', 'submit', array(
            'label' => 'Approve'
        ))
            ->add('disapprove', 'submit', array(
            'label' => 'Disapprove'
        ))
            ->add('onhold', 'submit', array(
            'label' => 'On hold'
        ));

        return $form;
    }

    /**
     * Updates a Cdp entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }
        
        $form = $this->createEditForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
            
            if ($form->get('approve')->isClicked()) {

                $user = $entity->getFeedbackcycle()->getUser();

                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'finished')
                    ->getQuery();

                $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                if ($systemmail->getMailtype()->getIsActive()) {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($systemmail->getSubject())
                        ->setFrom($systemmail->getSender())
                        ->setTo($user->getEmail())
                        ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('cdp_show', array('id' => $entity->getId())), $systemmail->getBody()));

                    $this->get('mailer')->send($message);
                }
                
                $formstatus = $repository->find(8);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully approved the CDP!'
                );
                
            } elseif ($form->get('disapprove')->isClicked()) {

                $user = $entity->getFeedbackcycle()->getUser();

                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'hrtoemployee')
                    ->getQuery();

                $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                if ($systemmail->getMailtype()->getIsActive()) {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($systemmail->getSubject())
                        ->setFrom($systemmail->getSender())
                        ->setTo($user->getEmail())
                        ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('cdp_edit', array('id' => $entity->getId())), $systemmail->getBody()));

                    $this->get('mailer')->send($message);
                }
                
                $formstatus = $repository->find(7);
                
                $this->addFlash(
                    'success',
                    'You\'ve succusfully disapproved the CDP!'
                );
                
            } elseif ($form->get('onhold')->isClicked()) {
                
                $formstatus = $repository->find(6);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully put the CDP on hold!'
                );
            } elseif ($form->get('save')->isClicked()) {
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully saved your progress!'
                );                
            }
            
            $entity->setFormstatus($formstatus);
            $em->flush();
            
            return $this->redirect($this->generateUrl('hr_dashboard', array(
                
            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:Cdp:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Displays a form to edit an existing Midyear entity.
     */
    public function addMidyearFeedbackAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyear')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Midyear entity.');
        }

        // CAN ONLY ADD FEEDBACK WHEN STATUS = 5
        //

        if ($entity->getFormstatus()->getId() == 5 || $entity->getFormstatus()->getId() == 6) {

            $form = $this->createMidyearEditForm($entity);
            $user = $this->getUser();

            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate');

            $query = $repository->createQueryBuilder('m')
                ->where('m.templateversion = :midyeartemplateversion')
                ->andWhere('m.language = :language')
                ->setParameter('midyeartemplateversion', $entity->getTemplateversion())
                ->setParameter('language', $user->getLanguage())
                ->getQuery();

            $template = $query->setMaxResults(1)->getOneOrNullResult();

            return $this->render('IntoPeopleDatabaseBundle:HR:feedbackMidyear.html.twig', array(
                'entity' => $entity,
                'template' => $template,
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
        $form = $this->createForm(new MidyearFeedbackType(), $entity, array(
            'action' => $this->generateUrl('hr_updateMidyear', array(
                'id' => $entity->getId()
            )),
            'method' => 'PUT'
        ));

        $form->add('save', 'submit', array(
            'label' => 'Save'
        ))
            ->add('approve', 'submit', array(
            'label' => 'Approve'
        ))
            ->add('disapprove', 'submit', array(
            'label' => 'Disapprove'
        ))
            ->add('onhold', 'submit', array(
            'label' => 'On hold'
        ));

        return $form;
    }
    
    /**
     * Updates a Midyear entity.
     */
    public function updateMidyearAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyear')->find($id);
    
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Midyear entity.');
        }
    
        $form = $this->createMidyearEditForm($entity);
        $form->handleRequest($request);
    
        if ($form->isValid()) {
    
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
    
            
            if ($form->get('approve')->isClicked()) {

                $user = $entity->getFeedbackcycle()->getUser();
                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'finished')
                    ->getQuery();

                $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                if ($systemmail->getMailtype()->getIsActive()) {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($systemmail->getSubject())
                        ->setFrom($systemmail->getSender())
                        ->setTo($user->getEmail())
                        ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('midyear_show', array('id' => $entity->getId())), $systemmail->getBody()));

                    $this->get('mailer')->send($message);
                }
                
                $formstatus = $repository->find(8);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully approved the CDP!'
                );
                
            } elseif ($form->get('disapprove')->isClicked()) {

                $user = $entity->getFeedbackcycle()->getUser();

                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'hrtoemployee')
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
                
                $formstatus = $repository->find(7);
                
                $this->addFlash(
                    'success',
                    'You\'ve succusfully disapproved the CDP!'
                );
                
            } elseif ($form->get('onhold')->isClicked()) {
                
                $formstatus = $repository->find(6);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully put the CDP on hold!'
                );
            } elseif ($form->get('save')->isClicked()) {
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully saved your progress!'
                );                
            }
    
            $entity->setFormstatus($formstatus);
            $em->flush();
    
            return $this->redirect($this->generateUrl('hr_dashboard', array(
                'id' => $entity->getId()
            )));
        }
    
        return $this->render('IntoPeopleDatabaseBundle:Midyear:show.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Displays a form to edit an existing Endyear entity.
     */
    public function addEndyearFeedbackAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyear')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Endyear entity.');
        }

        // CAN ONLY ADD FEEDBACK WHEN STATUS = 5
        //

        if ($entity->getFormstatus()->getId() == 5 || $entity->getFormstatus()->getId() == 6) {

            $form = $this->createEndyearEditForm($entity);
            $user = $this->getUser();

            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate');

            $query = $repository->createQueryBuilder('e')
                ->where('e.templateversion = :endyeartemplateversion')
                ->andWhere('e.language = :language')
                ->setParameter('endyeartemplateversion', $entity->getTemplateversion())
                ->setParameter('language', $user->getLanguage())
                ->getQuery();

            $template = $query->setMaxResults(1)->getOneOrNullResult();

            return $this->render('IntoPeopleDatabaseBundle:HR:feedbackEndyear.html.twig', array(
                'entity' => $entity,
                'template' => $template,
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
        $form = $this->createForm(new EndyearFeedbackType(), $entity, array(
            'action' => $this->generateUrl('hr_updateEndyear', array(
                'id' => $entity->getId()
            )),
            'method' => 'PUT'
        ));

        $form->add('save', 'submit', array(
            'label' => 'Save'
        ))
            ->add('approve', 'submit', array(
            'label' => 'Approve'
        ))
            ->add('disapprove', 'submit', array(
            'label' => 'Disapprove'
        ))
            ->add('onhold', 'submit', array(
            'label' => 'On hold'
        ));

        return $form;
    }
    
    /**
     * Updates a Endyear entity.
     */
    public function updateEndyearAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyear')->find($id);
    
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Endyear entity.');
        }
    
        $form = $this->createEndyearEditForm($entity);
        $form->handleRequest($request);
    
        if ($form->isValid()) {
    
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
    
            if ($form->get('approve')->isClicked()) {

                $user = $entity->getFeedbackcycle()->getUser();

                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'finished')
                    ->getQuery();

                $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                if ($systemmail->getMailtype()->getIsActive()) {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($systemmail->getSubject())
                        ->setFrom($systemmail->getSender())
                        ->setTo($user->getEmail())
                        ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('endyear_show', array('id' => $entity->getId())), $systemmail->getBody()));

                    $this->get('mailer')->send($message);
                }
                
                $formstatus = $repository->find(8);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully approved the CDP!'
                );
                
            } elseif ($form->get('disapprove')->isClicked()) {

                $user = $entity->getFeedbackcycle()->getUser();

                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $user->getLanguage())
                    ->setParameter('name', 'hrtoemployee')
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
                
                $formstatus = $repository->find(7);
                
                $this->addFlash(
                    'success',
                    'You\'ve succusfully disapproved the CDP!'
                );
                
            } elseif ($form->get('onhold')->isClicked()) {
                
                $formstatus = $repository->find(6);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully put the CDP on hold!'
                );
            } elseif ($form->get('save')->isClicked()) {
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully saved your progress!'
                );                
            }
    
            $entity->setFormstatus($formstatus);
            $em->flush();
    
            return $this->redirect($this->generateUrl('hr_dashboard', array(
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
                'choices'  => array('cdp' => 'Cdp')

            ))
            ->add('feedbackupload', 'file',array('constraints' => new File(array('maxSize' => "20M"
            ))))
            ->add('addfeedback', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();

            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($data['feedbackupload']);

            $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

            $worksheet = $objPHPExcel->getActiveSheet();

            $formtype = strtolower($worksheet->getCell('C1')->getValue());

            for ($i = 3; $i <= $highestRow; $i++){

                $feedbackid = $worksheet->getCell('A' . $i)->getValue();
                $feedback = $worksheet->getCell('F' . $i)->getValue();
                $status = $worksheet->getCell('E' . $i)->getValue();
                if (intval($feedbackid) != 0) {
                    $formid = '';
                    switch (strtolower($status)) {
                        case 'approved':
                            $formid = 8;
                            break;
                        case 'disapproved':
                            $formid = 7;
                            break;
                        case 'on hold':
                            $formid = 6;
                            break;
                    }
                    if ($formid != '') {


                        $feedbackcycle = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->find($feedbackid);
                        $formstatus = $em->getRepository('IntoPeopleDatabaseBundle:Formstatus')->find($formid);

                        if ($feedbackcycle != null) {
                            $theform = '';
                            if ($formtype == 'cdp') {
                                $theform = $feedbackcycle->getCdp();
                            } else if ($formtype == 'midyear') {
                                $theform = $feedbackcycle->getMidyear();
                            } else if ($formtype == 'endyear') {
                                $theform = $feedbackcycle->getEndyear();
                            }
                            if ($theform->getFormstatus()->getId() == 5) {

                            }
                            $theform->setFormstatus($formstatus);
                            $theform->setFeedbackhr($feedback);


                        }
                    }
                }

            }

            $em->flush();

        }

        return $this->render('IntoPeopleDatabaseBundle:HR:dashboard.html.twig', array(
            'form' => $form->createView(),
        ));



    }

    public function getcyclesAction($generalcycleid, $cycle){

        $em = $this->getDoctrine()->getManager();
        $feedbackcycles = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->findByGeneralcycle($generalcycleid);

        $entities = array();

        foreach ($feedbackcycles as $feedbackcycle){
            if ($cycle == "cdp"){
                $chosencycle = $feedbackcycle->getCdp();
            }else if ($cycle == "midyear"){
                $chosencycle = $feedbackcycle->getMidyear();
            }else if($cycle == "endyear"){
                $chosencycle = $feedbackcycle->getEndyear();
            }

            array_push($entities, $chosencycle);
        }


        return $this->render('IntoPeopleDatabaseBundle:HR:getcyclesview.html.twig', array(
            'entities' => $entities,
            'cycle' => $cycle,
        ));
    }

    public function getformstatuscountAction($generalcycleid, $cycle){


        $em = $this->getDoctrine()->getManager();
        $feedbackcycles = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->findByGeneralcycle($generalcycleid);

        $formcounts = array();

        foreach ($feedbackcycles as $feedbackcycle){
            if ($cycle == "cdp"){
                $chosencycle = $feedbackcycle->getCdp();
            }else if ($cycle == "midyear"){
                $chosencycle = $feedbackcycle->getMidyear();
            }else if($cycle == "endyear"){
                $chosencycle = $feedbackcycle->getEndyear();
            }

            array_push($formcounts, $chosencycle->getFormstatus()->getId());
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
            ->setParameter('ids', $chosencycleids)
            ->getQuery();

        $cycles = $query->getResult();

        $facade = $this->get('ps_pdf.facade');
        $response = new Response();
        $this->render('IntoPeopleDatabaseBundle:HR:' . $cycle . '.pdf.twig', array("entities" => $cycles), $response);

        $xml = $response->getContent();

        $content = $facade->render($xml);

        return new Response($content, 200, array('content-type' => 'application/pdf'));


    }

    public function remindermailAction($cycle, Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        $chosencycleids = json_decode($request->get('ids'));

        $query = $em->getRepository('IntoPeopleDatabaseBundle:' . ucfirst($cycle))->createQueryBuilder('c')
            ->where('c.id IN (:ids)')
            ->setParameter('ids', $chosencycleids)
            ->getQuery();

        $forms = $query->getResult();

        $query = $em->getRepository('IntoPeopleDatabaseBundle:Mailtype')->createQueryBuilder('m')
            ->where('m.name = :name')
            ->setParameter('name', 'remindermail')
            ->getQuery();

        $languages = $em->getRepository('IntoPeopleDatabaseBundle:Language')->findAll();

        $mails = array();
        $mailtype = $query->setMaxResults(1)->getOneOrNullResult();
        if ($mailtype->getIsActive()) {
            foreach ($languages as $language) {
                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $language)
                    ->setParameter('name', 'remindermail')
                    ->getQuery();

                $mails[$language->getName()] = $query->setMaxResults(1)->getOneOrNullResult();
            }

            foreach ($forms as $form){
                $user = $form->getFeedbackcycle()->getUser();
                $formstatusid = $form->getFormstatus()->getId();
                $url = '';
                if ($formstatusid == 1 | 2 | 4 | 7){
                    $mailuser = $user;
                    $url = $cycle . '_edit';
                }else if($formstatusid == 3){
                    $mailuser = $user->getSupervisor();
                    $url = 'supervisor_';
                    if ($cycle == 'cdp'){
                        $url .= 'addComment';
                    }else {
                        $url .= 'add' . ucfirst($cycle) . 'Comment';
                    }
                }



                $systemmail = $mails[$mailuser->getLanguage()->getName()];

                $message = \Swift_Message::newInstance()
                    ->setSubject($systemmail->getSubject())
                    ->setFrom($systemmail->getSender())
                    ->setTo($mailuser->getEmail())
                    ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl($url, array('id' => $form->getId())), $systemmail->getBody()));

                $this->get('mailer')->send($message);


            }

        }
        return new Response();
    }

    public function excelAction($cycle, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $chosencycleids = json_decode($request->get('ids'));

        $query = $em->getRepository('IntoPeopleDatabaseBundle:' . ucfirst($cycle))->createQueryBuilder('c')
            ->where('c.id IN (:ids)')
            ->setParameter('ids', $chosencycleids)
            ->getQuery();

        $forms = $query->getResult();
        $teller = 3;

        $path = $this->get('kernel')->getRootDir() . '/../web/assets/excel/feedback.xls';

        $excel = file_get_contents($path);

        $inputFileType = \PHPExcel_IOFactory::identify($path);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($path);


        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C1',$cycle);




        foreach ($forms as $form){
            $feedbackcycle = $form->getFeedbackcycle();

            $user = $feedbackcycle->getUser();
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $teller, $feedbackcycle->getId())
                        ->setCellValue('B' . $teller, $user->getFirstname())
                        ->setCellValue('C' . $teller, $user->getLastname())
                        ->setCellValue('D' . $teller, $user->getJobtitle()->getName());

            $objValidation = $objPHPExcel->getActiveSheet()->getCell('E' . $teller)->getDataValidation();
            $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Pick from list');
            $objValidation->setPrompt('Please pick a value from the drop-down list.');
            $objValidation->setFormula1('"Approved,Disapproved,On hold"');

            $teller++;
        }

        $writer = $this->get('phpexcel')->createWriter($objPHPExcel, 'Excel5');
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=' . 'feedback' . '.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;


    }

    public function historyAction($cycle, $id){
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('IntoPeopleDatabaseBundle:' . ucfirst($cycle) . 'history')->createQueryBuilder('h')
            ->where('h.' . $cycle . ' = :id')
            ->setParameter('id', $id)
            ->orderBy('h.date', 'ASC')
            ->getQuery();

        $entities = $query->getResult();

        return $this->render('IntoPeopleDatabaseBundle:HR:historymodal.html.twig', array(
            'entities' => $entities,
        ));


    }


}

