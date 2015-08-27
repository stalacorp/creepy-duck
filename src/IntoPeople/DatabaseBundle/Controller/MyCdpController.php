<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Cdp;
use IntoPeople\DatabaseBundle\Form\CdpType;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;
use IntoPeople\DatabaseBundle\Entity\Developmentneeds;
use IntoPeople\DatabaseBundle\Entity\Cdphistory;

/**
 * My cdp controller.
 */
class MyCdpController extends Controller
{

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
        $form = $this->createForm(new CdpType(), $entity, array(
            'action' => $this->generateUrl('cdp_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        
        $form
        ->add('save', 'submit', array('label' => 'Save'))
        ->add('saveAndAdd', 'submit', array('label' => 'Save and Submit'));
        
        return $form;
    }

    /**
     * Displays a form to edit an existing Cdp entity.
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);
        $user = $this->getUser();
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }

        if($user != $entity->getFeedbackcycle()->getUser()){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }
        // CAN ONLY FILL IN CDP WHEN STATUS = AVAILABLE OR ...
        //
        
        if ($entity->getFormstatus()->getId() == 1 || $entity->getFormstatus()->getId() == 2 || $entity->getFormstatus()->getId() == 4 || $entity->getFormstatus()->getId() == 7) {
            
            $form = $this->createEditForm($entity);

            
            // Send CDP template
            
            $template = $entity->getCdptemplate();
            
            return $this->render('IntoPeopleDatabaseBundle:Cdp:new.html.twig', array(
                'template' => $template,
                'entity' => $entity,
                'form' => $form->createView()
            ));
        }
        
        return $this->redirect($this->generateUrl('cdp_show', array(
            'id' => $entity->getId()
        )));
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
            
            if ($form->get('saveAndAdd')->isClicked()) {
                               
                $formstatus = $repository->find(3);
                                             
                // Notification message after organization has been created
                //
                $this->addFlash(
                    'success',
                    'Your Career development plan has been sent to your supervisor!'
                );

                $entity->setDateSubmitted(date('Y-m-d'));
                $user = $this->getUser();
                $supervisor = $user->getSupervisor();
                $entity->setSupervisor = $supervisor;

                if (!$supervisor) {
                    $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                        ->join('s.mailtype', 'm')
                        ->where('s.language = :id')
                        ->andWhere('m.name = :name')
                        ->setParameter('id', $supervisor->getLanguage())
                        ->setParameter('name', 'formtosupervisor')
                        ->getQuery();

                    $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                    if ($systemmail->getIsActive()) {
                        $message = \Swift_Message::newInstance()
                            ->setSubject($systemmail->getSubject())
                            ->setFrom($systemmail->getSender())
                            ->setTo($supervisor->getEmail())
                            ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('supervisor_addComment', array('id' => $entity->getId())), $systemmail->getBody()));

                        $this->get('mailer')->send($message);
                    }
                }

            } elseif ($form->get('save')->isClicked()) {

                $formstatus = $repository->find(2);
                                
                // Notification message after organization has been created
                //
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
        
        return $this->render('IntoPeopleDatabaseBundle:Cdp:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Finds and displays the Cdp.
     *
     */
    public function showAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);

        if($this->getUser() != $entity->getFeedbackcycle()->getUser()){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }
    
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }
        
        $template = $entity->getCdptemplate();
        
        return $this->render('IntoPeopleDatabaseBundle:Cdp:show.html.twig', array(
            'entity'      => $entity,
            'template' => $template
        ));
    }
}