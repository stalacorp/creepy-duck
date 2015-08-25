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

/**
 * Supervisor controller.
 */
class HRController extends Controller
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
            
            return $this->render('IntoPeopleDatabaseBundle:HR:feedback.html.twig', array(
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
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }
        
        $form = $this->createEditForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
            
            if ($form->get('approve')->isClicked()) {
                
                $formstatus = $repository->find(8);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully approved the CDP!'
                );
                
            } elseif ($form->get('disapprove')->isClicked()) {
                
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
            
            return $this->redirect($this->generateUrl('feedbackcycle', array(
                
            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:Cdp:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
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
    
            return $this->render('IntoPeopleDatabaseBundle:HR:feedbackMidyear.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
        }
    
        return $this->redirect($this->generateUrl('midyear_show', array(
            'id' => $entity->getId()
        )));
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
                
                $formstatus = $repository->find(8);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully approved the CDP!'
                );
                
            } elseif ($form->get('disapprove')->isClicked()) {
                
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
    
            return $this->redirect($this->generateUrl('feedbackcycle', array(
                'id' => $entity->getId()
            )));
        }
    
        return $this->render('IntoPeopleDatabaseBundle:Midyear:show.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
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
    
            return $this->render('IntoPeopleDatabaseBundle:HR:feedbackEndyear.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
        }
    
        return $this->redirect($this->generateUrl('endyear_show', array(
            'id' => $entity->getId()
        )));
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
                
                $formstatus = $repository->find(8);
                
                $this->addFlash(
                    'success',
                    'You\'ve succcesfully approved the CDP!'
                );
                
            } elseif ($form->get('disapprove')->isClicked()) {
                
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
    
            return $this->redirect($this->generateUrl('feedbackcycle', array(
                'id' => $entity->getId()
            )));
        }
    
        return $this->render('IntoPeopleDatabaseBundle:Endyear:show.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
}
