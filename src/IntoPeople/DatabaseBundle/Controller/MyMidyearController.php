<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Midyear;
use IntoPeople\DatabaseBundle\Form\MidyearType;
use IntoPeople\DatabaseBundle\Entity\Developmentneeds;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;

/**
 * My cdp controller.
 */
class MyMidyearController extends Controller
{
    /**
     * Creates a form to create a midyear entity.
     *
     * @param Cdp $entity
     *            The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Midyear $entity)
    {
        $form = $this->createForm(new MidyearType(), $entity, array(
            'action' => $this->generateUrl('midyear_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        

        $form
        ->add('save', 'submit', array('label' => 'Save'))
        ->add('saveAndAdd', 'submit', array('label' => 'Save and Submit'));
        
        return $form;
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyear')->find($id);
        $user = $this->getUser();
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Mid Year entity.');
        }

        if($user != $entity->getFeedbackcycle()->getUser()){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }
        // CAN ONLY FILL IN CDP WHEN STATUS = AVAILABLE OR ...
        //
        if ($entity->getFormstatus()->getId() == 1 || $entity->getFormstatus()->getId() == 2 || $entity->getFormstatus()->getId() == 4 || $entity->getFormstatus()->getId() == 7) {
        
            $form = $this->createEditForm($entity);

            $devneeds = $entity->getDevelopmentNeeds();

            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate');

            $query = $repository->createQueryBuilder('m')
                ->where('m.templateversion = :midyeartemplateversion')
                ->andWhere('m.language = :language')
                ->setParameter('midyeartemplateversion', $entity->getTemplateversion())
                ->setParameter('language', $user->getLanguage())
                ->getQuery();

            $template = $query->setMaxResults(1)->getOneOrNullResult();
        
            return $this->render('IntoPeopleDatabaseBundle:Midyear:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView(),
                'devneeds' => $devneeds,
                'template' => $template
            ));
        }
        
        return $this->redirect($this->generateUrl('midyear_show', array(
            'id' => $entity->getId()
        )));
       
    }

    /**
     * Updates a Midyear entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyear')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mid Year entity.');
        }
        
        $form = $this->createEditForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
            
            if ($form->get('saveAndAdd')->isClicked()) {
                              
                $formstatus = $repository->find(3);

                $entity->setDateSubmitted(new \DateTime(date('Y-m-d')));
                $user = $this->getUser();
                $supervisor = $user->getSupervisor();
                $entity->setSupervisor($supervisor);

                if ($supervisor) {
                    $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                        ->join('s.mailtype', 'm')
                        ->where('s.language = :id')
                        ->andWhere('m.name = :name')
                        ->setParameter('id', $supervisor->getLanguage())
                        ->setParameter('name', 'formtosupervisor')
                        ->getQuery();

                    $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                    if ($systemmail->getMailtype()->getIsActive()) {
                        $message = \Swift_Message::newInstance()
                            ->setSubject($systemmail->getSubject())
                            ->setFrom($systemmail->getSender())
                            ->setTo($supervisor->getEmail())
                            ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('supervisor_addMidyearComment', array('id' => $entity->getId())), $systemmail->getBody()));

                        $this->get('mailer')->send($message);
                    }
                }
                
                $this->addFlash(
                    'success',
                    'Your Career development plan has been sent to your supervisor!'
                );
                
               
            } elseif ($form->get('save')->isClicked()) {
                
                $formstatus = $repository->find(2);
                
                $this->addFlash(
                    'success',
                    'Your changes have been saved!'
                );
                
            } 
            
            $entity->setFormstatus($formstatus);
            
            $em->flush();
            
            return $this->redirect($this->generateUrl('myfeedbackcycle', array(
                'id' => $entity->getId()
            )));
        }

        $user = $this->getUser();

        $devneeds = $entity->getDevelopmentNeeds();

        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate');

        $query = $repository->createQueryBuilder('m')
            ->where('m.templateversion = :midyeartemplateversion')
            ->andWhere('m.language = :language')
            ->setParameter('midyeartemplateversion', $entity->getTemplateversion())
            ->setParameter('language', $user->getLanguage())
            ->getQuery();

        $template = $query->setMaxResults(1)->getOneOrNullResult();
        
        return $this->render('IntoPeopleDatabaseBundle:Midyear:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'devneeds' => $devneeds,
            'template' => $template
        ));
    }
    
    /**
     * Finds and displays the Midyear.
     *
     */
    public function showAction($id)
    {
    
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyear')->find($id);
    
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Midyear entity.');
        }

        $securityContext = $this->container->get('security.context');
        if($this->getUser() != $entity->getFeedbackcycle()->getUser() & !$securityContext->isGranted('ROLE_HR')){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }

        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate');

        $query = $repository->createQueryBuilder('m')
            ->where('m.templateversion = :midyeartemplateversion')
            ->setParameter('midyeartemplateversion', $entity->getTemplateversion())
            ->getQuery();

        $template = $query->setMaxResults(1)->getOneOrNullResult();

    
        return $this->render('IntoPeopleDatabaseBundle:Midyear:show.html.twig', array(
            'entity'      => $entity,
            'template' => $template
        ));
    }
}