<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;

use IntoPeople\DatabaseBundle\Entity\Templateversion;
use IntoPeople\DatabaseBundle\Form\TemplateversionType;

/**
 * Templateversion controller.
 *
 */
class TemplateversionController extends Controller
{

    /**
     * Lists all Templateversion entities.
     *
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('templateversion', 'entity', array(
                'class' => 'IntoPeopleDatabaseBundle:Templateversion',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t');
                },
            ))
            ->add('cycle', 'choice', array(
                'choices' => array(
                    'cdp' => 'Cdp',
                    'midyear' => 'Mid Year',
                    'endyear' => 'Year End'
                )

            ))
            ->getForm();

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntoPeopleDatabaseBundle:Templateversion')->findAll();

        return $this->render('IntoPeopleDatabaseBundle:Templateversion:index.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView()
        ));
    }

    public function getcyclesAction($templateversionId, $cycle)
    {

        $em = $this->getDoctrine()->getManager();
        $templateversion = $em->getRepository('IntoPeopleDatabaseBundle:Templateversion')->find($templateversionId);

        #$entities = array();

        if ($cycle == "cdp") {
            $templates = $templateversion->getCdptemplates();
        } else if ($cycle == "midyear") {
            $templates = $templateversion->getMidyeartemplates();
        } else if ($cycle == "endyear") {
            $templates = $templateversion->getEndyeartemplates();
        }

        #array_push($entities, $chosencycle);


        return $this->render('IntoPeopleDatabaseBundle:Templateversion:gettemplates.html.twig', array(
            'templates' => $templates,
            'cycle' => $cycle,
            'templateversionId' => $templateversionId
        ));
    }

    /**
     * Creates a new Templateversion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Templateversion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('templateversion_show', array('id' => $entity->getId())));
        }

        return $this->render('IntoPeopleDatabaseBundle:Templateversion:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Templateversion entity.
     *
     * @param Templateversion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Templateversion $entity)
    {
        $form = $this->createForm(new TemplateversionType(), $entity, array(
            'action' => $this->generateUrl('templateversion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Templateversion entity.
     *
     */
    public function newAction()
    {
        $entity = new Templateversion();
        $form = $this->createCreateForm($entity);

        return $this->render('IntoPeopleDatabaseBundle:Templateversion:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Templateversion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Templateversion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Templateversion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Templateversion:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Templateversion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Templateversion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Templateversion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Templateversion:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Templateversion entity.
     *
     * @param Templateversion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Templateversion $entity)
    {
        $form = $this->createForm(new TemplateversionType(), $entity, array(
            'action' => $this->generateUrl('templateversion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Templateversion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Templateversion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Templateversion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('templateversion_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Templateversion:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Templateversion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Templateversion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Templateversion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('templateversion'));
    }

    /**
     * Creates a form to delete a Templateversion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('templateversion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
