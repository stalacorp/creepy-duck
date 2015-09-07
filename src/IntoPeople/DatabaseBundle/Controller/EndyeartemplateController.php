<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IntoPeople\DatabaseBundle\Entity\Endyeartemplate;
use IntoPeople\DatabaseBundle\Form\EndyeartemplateType;

/**
 * Endyeartemplate controller.
 *
 */
class EndyeartemplateController extends Controller
{

    /**
     * Lists all Endyeartemplate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate')->findAll();

        return $this->render('IntoPeopleDatabaseBundle:Endyeartemplate:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Endyeartemplate entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Endyeartemplate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            // Date is current date
            // ---
            $dt = new \DateTime();
            $dt->format('Y-m-d');
            $entity->setDate($dt);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('endyeartemplate_show', array('id' => $entity->getId())));
        }

        return $this->render('IntoPeopleDatabaseBundle:Endyeartemplate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Endyeartemplate entity.
     *
     * @param Endyeartemplate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Endyeartemplate $entity)
    {
        $form = $this->createForm(new EndyeartemplateType(), $entity, array(
            'action' => $this->generateUrl('endyeartemplate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Endyeartemplate entity.
     *
     */
    public function newAction()
    {
        $entity = new Endyeartemplate();
        $form   = $this->createCreateForm($entity);

        return $this->render('IntoPeopleDatabaseBundle:Endyeartemplate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Endyeartemplate entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Endyeartemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Endyeartemplate:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Endyeartemplate entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Endyeartemplate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Endyeartemplate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Endyeartemplate entity.
    *
    * @param Endyeartemplate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Endyeartemplate $entity)
    {
        $form = $this->createForm(new EndyeartemplateType(), $entity, array(
            'action' => $this->generateUrl('endyeartemplate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Endyeartemplate entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Endyeartemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('endyeartemplate_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Endyeartemplate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Endyeartemplate entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Endyeartemplate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('endyeartemplate'));
    }

    /**
     * Creates a form to delete a Endyeartemplate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('endyeartemplate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
