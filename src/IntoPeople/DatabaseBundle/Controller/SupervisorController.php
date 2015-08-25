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
     * Creates a form to edit a cdp entity.
     *
     * @param Cdp $entity
     *            The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Cdp $entity)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
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
     * Displays a form to edit an existing Cdp entity.
     */
    public function addCommentAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }
        
        // CAN ONLY ADD COMMENT WHEN STATUS = 3
        //
        
        if ($entity->getFormstatus()->getId() == 3 ) {
        
            $form = $this->createEditForm($entity);
            $user = $this->getUser();
        
            // Send CDP template
        
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');
        
            // createQueryBuilder automatically selects FROM IntoPeopleDatabaseBundle:Cdptemplate
            // and aliases it to "c"
            $query = $repository->createQueryBuilder('c')
            ->where('c.organization = :id')
            ->setParameter('id', $user->getOrganization()
                ->getId())
                ->getQuery();
        
            $template = $query->setMaxResults(1)->getOneOrNullResult();
            // to get just one result:
            // $product = $query->setMaxResults(1)->getOneOrNullResult();
        
            return $this->render('IntoPeopleDatabaseBundle:Supervisor:feedback.html.twig', array(
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
                
                $formstatus = $repository->find(5);
                
                $this->addFlash(
                    'success',
                    'You\'ve succesfully approved the CDP!'
                );
                                              
            } elseif ($form->get('disapprove')->isClicked()) {

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
                
            )));
        }
    
        return $this->render('IntoPeopleDatabaseBundle:Cdp:show.html.twig', array(
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
     * Displays a form to edit an existing Midyear entity.
     */
    public function addMidyearCommentAction($id) {
    
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyear')->find($id);
    
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Midyear entity.');
        }
    
        // CAN ONLY ADD COMMENT WHEN STATUS = 3
        //
    
        if ($entity->getFormstatus()->getId() == 3 ) {
    
            $form = $this->createMidyearEditForm($entity);
            $user = $this->getUser();
    
            // Send CDP template
    
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate');
    
            // createQueryBuilder automatically selects FROM IntoPeopleDatabaseBundle:Cdptemplate
            // and aliases it to "c"
            $query = $repository->createQueryBuilder('c')
            ->where('c.organization = :id')
            ->setParameter('id', $user->getOrganization()
                ->getId())
                ->getQuery();
    
            $template = $query->setMaxResults(1)->getOneOrNullResult();
            // to get just one result:
            // $product = $query->setMaxResults(1)->getOneOrNullResult();
    
            return $this->render('IntoPeopleDatabaseBundle:Supervisor:feedbackMidyear.html.twig', array(
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
     * Displays a form to edit an existing Yearend entity.
     */
    public function addEndyearCommentAction($id) {
    
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyear')->find($id);
    
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Endyear entity.');
        }
    
        // CAN ONLY ADD COMMENT WHEN STATUS = 3
        //
    
        if ($entity->getFormstatus()->getId() == 3 ) {
    
            $form = $this->createEndyearEditForm($entity);
            $user = $this->getUser();
    
            // Send CDP template
    
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate');
    
            // createQueryBuilder automatically selects FROM IntoPeopleDatabaseBundle:Cdptemplate
            // and aliases it to "c"
            $query = $repository->createQueryBuilder('c')
            ->where('c.organization = :id')
            ->setParameter('id', $user->getOrganization()->getId())
            ->orderby('c.date','DESC')
            ->getQuery();
    
            $template = $query->setMaxResults(1)->getOneOrNullResult();
            // to get just one result:
            // $product = $query->setMaxResults(1)->getOneOrNullResult();
    
            return $this->render('IntoPeopleDatabaseBundle:Supervisor:feedbackEndyear.html.twig', array(
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
}

