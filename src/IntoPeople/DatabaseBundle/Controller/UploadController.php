<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IntoPeople\DatabaseBundle\Entity\Upload;
use IntoPeople\DatabaseBundle\Form\UploadType;

/**
 * Upload controller.
 *
 */
class UploadController extends Controller
{

    /**
     * Lists all Upload entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntoPeopleDatabaseBundle:Upload')->findAll();

        return $this->render('IntoPeopleDatabaseBundle:Upload:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Upload entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Upload();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('upload_show', array('id' => $entity->getId())));
        }

        return $this->render('IntoPeopleDatabaseBundle:Upload:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Upload entity.
     *
     * @param Upload $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Upload $entity)
    {
        $form = $this->createForm(new UploadType(), $entity, array(
            'action' => $this->generateUrl('upload_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Upload entity.
     *
     */
    public function newAction()
    {
        $entity = new Upload();
        $form   = $this->createCreateForm($entity);

        return $this->render('IntoPeopleDatabaseBundle:Upload:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Upload entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Upload')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Upload entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Upload:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Upload entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Upload')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Upload entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Upload:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Upload entity.
    *
    * @param Upload $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Upload $entity)
    {
        $form = $this->createForm(new UploadType(), $entity, array(
            'action' => $this->generateUrl('upload_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Upload entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Upload')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Upload entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('upload_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Upload:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Upload entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Upload')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Upload entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('upload'));
    }

    /**
     * Creates a form to delete a Upload entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('upload_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
