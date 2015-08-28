<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Endyear;
use IntoPeople\DatabaseBundle\Form\EndyearType;
use IntoPeople\DatabaseBundle\Entity\Developmentneeds;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;

/**
 * My endyear controller.
 */
class MyEndyearController extends Controller
{
    
    /**
     * Creates a form to create a endyear entity.
     *
     * @param Endyear $entity
     *            The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Endyear $entity)
    {
        $form = $this->createForm(new EndyearType(), $entity, array(
            'action' => $this->generateUrl('endyear_update', array('id' => $entity->getId())),
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
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyear')->find($id);
        $user = $this->getUser();
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find End Year entity.');
        }

        if($user != $entity->getFeedbackcycle()->getUser()){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }
        // CAN ONLY FILL IN CDP WHEN STATUS = AVAILABLE OR ...
        //
        
        if ($entity->getFormstatus()->getId() == 1 || $entity->getFormstatus()->getId() == 2 || $entity->getFormstatus()->getId() == 4 || $entity->getFormstatus()->getId() == 7) {
            
            $form = $this->createEditForm($entity);

            
            // Send CDP template
            
            $template = $entity->getEndyeartemplate();
            
            return $this->render('IntoPeopleDatabaseBundle:Endyear:new.html.twig', array(
                'template' => $template,
                'entity' => $entity,
                'form' => $form->createView()
            ));
        }
        
        return $this->redirect($this->generateUrl('endyear_show', array(
            'id' => $entity->getId()
        )));
         
    }

    /**
     * Update a new Endyear entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyear')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find End Year entity.');
        }
        
        $form = $this->createEditForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            if ($form->get('saveAndAdd')->isClicked()) {

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
                            ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('supervisor_addEndyearComment', array('id' => $entity->getId())), $systemmail->getBody()));

                        $this->get('mailer')->send($message);
                    }
                }
                
                $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
                $formstatus = $repository->find(3);
                
                $entity->setFormstatus($formstatus);
            } elseif ($form->get('save')->isClicked()) {
                $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
                $formstatus = $repository->find(2);
                
                $entity->setFormstatus($formstatus);
            }
            
            $em->flush();
            
            return $this->redirect($this->generateUrl('myfeedbackcycle', array(
                'id' => $entity->getId()
            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:Endyear:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    
    /**
     * Finds and displays the Endyear entity.
     *
     */
    public function showAction($id)
    {
    
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyear')->find($id);
    
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Endyear entity.');
        }

        $securityContext = $this->container->get('security.context');
        if($this->getUser() != $entity->getFeedbackcycle()->getUser() & $securityContext->isGranted('ROLE_HR')){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }
    
        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate');
    
        $template = $repository->find(1);
    
        return $this->render('IntoPeopleDatabaseBundle:Endyear:show.html.twig', array(
            'entity'      => $entity,
            'template' => $template
        ));
    }
}