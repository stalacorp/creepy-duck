<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IntoPeople\DatabaseBundle\Entity\Corequality;
use IntoPeople\DatabaseBundle\Form\CorequalityType;

/**
 * Corequality controller.
 *
 */
class CorequalityController extends Controller
{

    /**
     * Lists all Corequality entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntoPeopleDatabaseBundle:Corequality')->findAll();

        return $this->render('IntoPeopleDatabaseBundle:Corequality:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Corequality entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Corequality();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            // Notification message after Core Quality has been created
            //
            $tr = $this->get('translator');
            $message = $tr->trans('notification.create.corequality');

            $this->addFlash(
                'success',
                $message
            );

            return $this->redirect($this->generateUrl('corequality', array('id' => $entity->getId())));
        }

        return $this->render('IntoPeopleDatabaseBundle:Corequality:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Corequality entity.
     *
     * @param Corequality $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Corequality $entity)
    {
        $form = $this->createForm(new CorequalityType(), $entity, array(
            'action' => $this->generateUrl('corequality_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Corequality entity.
     *
     */
    public function newAction()
    {
        $entity = new Corequality();
        $form   = $this->createCreateForm($entity);

        return $this->render('IntoPeopleDatabaseBundle:Corequality:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Corequality entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Corequality')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Corequality entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Corequality:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Corequality entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Corequality')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Corequality entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Corequality:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Corequality entity.
    *
    * @param Corequality $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Corequality $entity)
    {
        $form = $this->createForm(new CorequalityType(), $entity, array(
            'action' => $this->generateUrl('corequality_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Corequality entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Corequality')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Corequality entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            // Notification message after Core Quality has been created
            //
            $tr = $this->get('translator');
            $message = $tr->trans('notification.edit.corequality');

            $this->addFlash(
                'success',
                $message
            );

            return $this->redirect($this->generateUrl('corequality_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Corequality:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Corequality entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Corequality')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Corequality entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('corequality'));
    }

    /**
     * Creates a form to delete a Corequality entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('corequality_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
