<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IntoPeople\DatabaseBundle\Entity\Language;
use IntoPeople\DatabaseBundle\Form\LanguageType;

/**
 * Language controller.
 *
 */
class LanguageController extends Controller
{
    /**
     * Lists all Language entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $languages = $em->getRepository('IntoPeopleDatabaseBundle:Language')->findAll();

        return $this->render('IntoPeopleDatabaseBundle:Language:index.html.twig', array(
            'languages' => $languages,
        ));
    }
    /**
     * Creates a new Language entity.
     *
     */
    public function createAction(Request $request)
    {
        $language = new Language();
        $form = $this->createCreateForm($language);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($language);
            $em->flush();

            return $this->redirect($this->generateUrl('language_show', array('id' => $language->getId())));
        }

        return $this->render('IntoPeopleDatabaseBundle:Language:new.html.twig', array(
            'language' => $language,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Language entity.
     *
     * @param Language $language The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Language $language)
    {
        $form = $this->createForm(new LanguageType(), $language, array(
            'action' => $this->generateUrl('language_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Language entity.
     *
     */
    public function newAction()
    {
        $language = new Language();
        $form   = $this->createCreateForm($language);

        return $this->render('IntoPeopleDatabaseBundle:Language:new.html.twig', array(
            'language' => $language,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Language entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $language = $em->getRepository('IntoPeopleDatabaseBundle:Language')->find($id);

        if (!$language) {
            throw $this->createNotFoundException('Unable to find Language entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Language:show.html.twig', array(
            'language' => $language,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Language entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $language = $em->getRepository('IntoPeopleDatabaseBundle:Language')->find($id);

        if (!$language) {
            throw $this->createNotFoundException('Unable to find Language entity.');
        }

        $editForm = $this->createEditForm($language);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Language:edit.html.twig', array(
            'language' => $language,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Language entity.
    *
    * @param Language $language The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Language $language)
    {
        $form = $this->createForm(new LanguageType(), $language, array(
            'action' => $this->generateUrl('language_update', array('id' => $language->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Language entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $language = $em->getRepository('IntoPeopleDatabaseBundle:Language')->find($id);

        if (!$language) {
            throw $this->createNotFoundException('Unable to find Language entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($language);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('language_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Language:edit.html.twig', array(
            'language' => $language,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Language entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $language = $em->getRepository('IntoPeopleDatabaseBundle:Language')->find($id);

            if (!$language) {
                throw $this->createNotFoundException('Unable to find Language entity.');
            }

            $em->remove($language);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('language'));
    }

    /**
     * Creates a form to delete a Language entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('language_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
