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
use IntoPeople\DatabaseBundle\Entity\Cdphistory;

/**
 * Feedbackcycle controller.
 *
 */
class FeedbackcycleController extends Controller
{

    /**
     * Lists all Feedbackcycle entities.
     *
     */
    public function indexAction()
    {
        // ALL FEEDBACKCYCLES IN USER'S ORGANIZATION
        // -----------------------------------------
        
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
            ->where('g.generalcyclestatus = :generalcyclestatus')
            ->setParameter('generalcyclestatus', 1 )
            ->orderby('u.firstname')
            ->getQuery();
        
        $entities = $query->getResult();

        return $this->render('IntoPeopleDatabaseBundle:Feedbackcycle:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Feedbackcycle entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Feedbackcycle();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $unavailable = $em->getRepository('IntoPeopleDatabaseBundle:Formstatus')->find(9);
            
            $available = $em->getRepository('IntoPeopleDatabaseBundle:Formstatus')->find(1);
            
            // FIND NEWEST CDP TEMPLATE
            // ---
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');
            
            $cdptemplate = $repository->findNewest($entity->getUser()->getOrganization());
            
            // FIND NEWEST MID YEAR TEMPLATE
            // ---
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate');
            
            $midyeartemplate = $repository->findNewest($entity->getUser()->getOrganization());
            
            // FIND NEWEST END YEAR TEMPLATE
            // ---
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate');
            
            $endyeartemplate = $repository->findNewest($entity->getUser()->getOrganization());
                        
            $developmentneeds = new Developmentneeds();
            
            $cdp = new Cdp();
            $cdp->setDevelopmentneeds($developmentneeds);
            $cdp->setFormstatus($available);
            $cdp->setCdptemplate($cdptemplate);
            $entity->setCdp($cdp);
            
            $midyear = new Midyear();
            $midyear->setDevelopmentneeds($developmentneeds);
            $midyear->setFormstatus($unavailable);
            $midyear->setMidyeartemplate($midyeartemplate);
            $entity->setMidyear($midyear);
            
            $endyear = new Endyear();
            $endyear->setDevelopmentneeds($developmentneeds);
            $endyear->setFormstatus($unavailable);
            $endyear->setEndyeartemplate($endyeartemplate);
            $entity->setEndyear($endyear);
                       
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('feedbackcycle_show', array('id' => $entity->getId())));
        }

        return $this->render('IntoPeopleDatabaseBundle:Feedbackcycle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Feedbackcycle entity.
     *
     * @param Feedbackcycle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Feedbackcycle $entity)
    {
        $form = $this->createForm(new FeedbackcycleType(), $entity, array(
            'action' => $this->generateUrl('feedbackcycle_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Feedbackcycle entity.
     *
     */
    public function newAction()
    {
        $entity = new Feedbackcycle();
        $form   = $this->createCreateForm($entity);

        return $this->render('IntoPeopleDatabaseBundle:Feedbackcycle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Feedbackcycle entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Feedbackcycle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Feedbackcycle:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Feedbackcycle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Feedbackcycle entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Feedbackcycle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Feedbackcycle entity.
    *
    * @param Feedbackcycle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Feedbackcycle $entity)
    {
        $form = $this->createForm(new FeedbackcycleType(), $entity, array(
            'action' => $this->generateUrl('feedbackcycle_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Feedbackcycle entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Feedbackcycle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('feedbackcycle_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Feedbackcycle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Feedbackcycle entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Feedbackcycle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('feedbackcycle'));
    }

    /**
     * Creates a form to delete a Feedbackcycle entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('feedbackcycle_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
