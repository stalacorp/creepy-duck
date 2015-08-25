<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IntoPeople\DatabaseBundle\Entity\Midyeartemplate;
use IntoPeople\DatabaseBundle\Form\MidyeartemplateType;

/**
 * Midyeartemplate controller.
 *
 */
class MidyeartemplateController extends Controller
{

    /**
     * Lists all Midyeartemplate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate')->findAll();

        return $this->render('IntoPeopleDatabaseBundle:Midyeartemplate:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Midyeartemplate entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Midyeartemplate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $user = $this->getUser();
            
            // Date is current date
            // ---
            $dt = new \DateTime();
            $dt->format('Y-m-d');
            $entity->setDate($dt);
            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('midyeartemplate_show', array('id' => $entity->getId())));
        }

        return $this->render('IntoPeopleDatabaseBundle:Midyeartemplate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Midyeartemplate entity.
     *
     * @param Midyeartemplate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Midyeartemplate $entity)
    {
        $form = $this->createForm(new MidyeartemplateType(), $entity, array(
            'action' => $this->generateUrl('midyeartemplate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Midyeartemplate entity.
     *
     */
    public function newAction()
    {
        $entity = new Midyeartemplate();
        $form   = $this->createCreateForm($entity);

        return $this->render('IntoPeopleDatabaseBundle:Midyeartemplate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Midyeartemplate entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Midyeartemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Midyeartemplate:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Midyeartemplate entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Midyeartemplate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Midyeartemplate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Midyeartemplate entity.
    *
    * @param Midyeartemplate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Midyeartemplate $entity)
    {
        $form = $this->createForm(new MidyeartemplateType(), $entity, array(
            'action' => $this->generateUrl('midyeartemplate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Midyeartemplate entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Midyeartemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('midyeartemplate_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Midyeartemplate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Midyeartemplate entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Midyeartemplate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('midyeartemplate'));
    }

    /**
     * Creates a form to delete a Midyeartemplate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('midyeartemplate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
