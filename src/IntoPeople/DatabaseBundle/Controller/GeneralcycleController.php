<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Generalcycle;
use IntoPeople\DatabaseBundle\Entity\Generalcyclestatus;
use IntoPeople\DatabaseBundle\Form\GeneralcycleType;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;
use IntoPeople\DatabaseBundle\Entity\Cdp;
use IntoPeople\DatabaseBundle\Entity\Midyear;
use IntoPeople\DatabaseBundle\Entity\Endyear;
use IntoPeople\DatabaseBundle\Entity\User;
use IntoPeople\DatabaseBundle\Entity\Developmentneeds;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use IntoPeople\DatabaseBundle\Entity\Cdphistory;

/**
 * Generalcycle controller.
 */
class GeneralcycleController extends Controller
{
    

    /**
     * Lists all Generalcycle entities.
     */
    public function indexAction()
    {
         
        $user = $this->getUser();  
        $em = $this->getDoctrine()->getManager();  
        
        // Only one generalcycle should be active?
        // ---
        
        // ACTIVE GENERALCYCLE
        // -------------------        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->getActiveCycleByOrganization();
            
        // FINISHED GENERALCYCLE
        // ---------------------              
        $finished = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->getFinishedCyclesByOrganization();
        
        // INACTIVE GENERALCYCLE
        // ---------------------
        $inactive = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->getInactiveCyclesByOrganization();
             
        
               
        return $this->render('IntoPeopleDatabaseBundle:Generalcycle:index.html.twig', array(
            'entity' => $entity,
            'finished' => $finished,
            'inactive' => $inactive
        ));
    }

    /**
     * Creates a new Generalcycle entity.
     */
    public function createAction(Request $request)
    {
        $user = $this->getUser();
        
        $entity = new Generalcycle();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
                           
        if ($form->isValid()) {
                                              
            $em = $this->getDoctrine()->getManager();
                  
            
            // Does generalcycle with this year already exist?
            if ($em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->checkYearByOrganization($user->getOrganization(), $entity->getYear())) {
                
                $this->addFlash(
                    'error',
                    'A cycle already exists for ' . $entity->getYear() . '!'
                );
                
                return $this->render('IntoPeopleDatabaseBundle:Generalcycle:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
                
            }



            if ($em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->getActiveCycleByOrganization()) {
                
                $status = $em->getReference('IntoPeopleDatabaseBundle:Generalcyclestatus', 3);
                
            } else {
                
                $status = $em->getReference('IntoPeopleDatabaseBundle:Generalcyclestatus', 1);
                
            }
            
            $entity->setGeneralcyclestatus($status);
                      
            // Set organization of generalcycle to user's organization
            if($entity->getOrganization() == null) {
                $entity->setOrganization($user->getOrganization());
            }
            
            // Startdate is current date
            $dt = new \DateTime();
            $entity->setStartdate($dt);
           
            // Generalcycle started by current user
            $user = $this->getUser();       
            $entity->setStartedby($user);
            
            
            // Foreach user in organization create feedbackcycle for generalcycle      
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User');
              
            $users = $repository->findAll();
            
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
            
            $available = $repository->find(1);
            $unavailable = $repository->find(9);
                    
            // FIND NEWEST CDP TEMPLATE
            // ---
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');
              
            $cdptemplate = $repository->findNewest();
            
            // FIND NEWEST MID YEAR TEMPLATE
            // ---            
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate');
            
            $midyeartemplate = $repository->findNewest();
            
            // FIND NEWEST END YEAR TEMPLATE
            // ---           
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate');
            
            $endyeartemplate = $repository->findNewest();
            
            
            foreach ($users as $user) {

                if($user->getUserstatus()->getId() == 1) {

                    $feedbackcycle = new Feedbackcycle();
                    $feedbackcycle->setUser($user);
                    $feedbackcycle->setGeneralcycle($entity);

                    $developmentneeds = new Developmentneeds();

                    $cdp = new Cdp();
                    $cdp->setDevelopmentneeds($developmentneeds);
                    $cdp->setFormstatus($available);
                    $cdp->setCdptemplate($cdptemplate);

                    $feedbackcycle->setCdp($cdp);

                    $midyear = new Midyear();
                    $midyear->setDevelopmentneeds($developmentneeds);
                    $midyear->setFormstatus($unavailable);
                    $midyear->setMidyeartemplate($midyeartemplate);

                    $feedbackcycle->setMidyear($midyear);

                    $endyear = new Endyear();
                    $endyear->setDevelopmentneeds($developmentneeds);
                    $endyear->setFormstatus($unavailable);
                    $endyear->setEndyeartemplate($endyeartemplate);

                    $feedbackcycle->setEndyear($endyear);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($feedbackcycle);
                }

            }
            
            $em->persist($entity);
            $em->flush();

            // Notification message after Core Quality has been created
            //
            $tr = $this->get('translator');
            $message = $tr->trans('notification.create.generalcycle');

            $this->addFlash(
                'success',
                $message
            );
            
            return $this->redirect($this->generateUrl('generalcycle', array(
                'id' => $entity->getId(),

            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:Generalcycle:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Generalcycle entity.
     *
     * @param Generalcycle $entity
     *            The entity
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Generalcycle $entity)
    {
        $tokenStorage = $this->container->get('security.token_storage');
        $locale = $this->get('request')->getLocale();
        $form = $this->createForm(new GeneralcycleType($tokenStorage, $locale), $entity, array(
            'action' => $this->generateUrl('generalcycle_create'),
            'method' => 'POST'
        ));
        
        $form->add('submit', 'submit', array(
            'label' => 'Create'
        ));
        
        return $form;
    }

    /**
     * Displays a form to create a new Generalcycle entity.
     */
    public function newAction()
    {
        $entity = new Generalcycle();
        $form = $this->createCreateForm($entity);
        
        return $this->render('IntoPeopleDatabaseBundle:Generalcycle:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a Generalcycle entity.
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Generalcycle entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('IntoPeopleDatabaseBundle:Generalcycle:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Generalcycle entity.
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Generalcycle entity.');
        }
        
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('IntoPeopleDatabaseBundle:Generalcycle:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Creates a form to edit a Generalcycle entity.
     *
     * @param Generalcycle $entity
     *            The entity
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Generalcycle $entity)
    {
        $tokenStorage = $this->container->get('security.token_storage');
        $options = array();
        $locale = $this->get('request')->getLocale();
        $form = $this->createForm(new GeneralcycleType($tokenStorage, $locale), $entity, array(
            'action' => $this->generateUrl('generalcycle_update', array(
                'id' => $entity->getId()
            )),
            'method' => 'PUT'
        ));
        
        $form->add('submit', 'submit', array(
            'label' => 'Update'
        ));
        
        return $form;
    }

    /**
     * Edits an existing Generalcycle entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Generalcycle entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            // Notification message after Core Quality has been created
            //
            $tr = $this->get('translator');
            $message = $tr->trans('notification.edit.generalcycle');

            $this->addFlash(
                'success',
                $message
            );
            
            return $this->redirect($this->generateUrl('generalcycle_edit', array(
                'id' => $id
            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:Generalcycle:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Deletes a Generalcycle entity.
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->find($id);
            
            if (! $entity) {
                throw $this->createNotFoundException('Unable to find Generalcycle entity.');
            }
            
            $em->remove($entity);
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('generalcycle'));
    }

    /**
     * Creates a form to delete a Generalcycle entity by id.
     *
     * @param mixed $id
     *            The entity id
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('generalcycle_delete', array(
            'id' => $id
        )))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
            'label' => 'Delete'
        ))
            ->getForm();
    }
    

}
