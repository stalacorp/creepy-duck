<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IntoPeople\DatabaseBundle\Entity\Systemmail;
use IntoPeople\DatabaseBundle\Form\SystemmailType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Systemmail controller.
 *
 */
class SystemmailController extends Controller
{

    /**
     * Lists all Systemmail entities.
     *
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('defaultemail', 'email')
            ->add('setemail', 'submit')
            ->add('language', 'entity', array(
                'class' => 'IntoPeopleDatabaseBundle:Language',
            ))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $defaultmail = $data['defaultemail'];


            $emails = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->findAll();
            foreach ($emails as $email){
                $email->setSender($defaultmail);
            }

            $em->flush();

        }

        return $this->render('IntoPeopleDatabaseBundle:Systemmail:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function getmailsAction($id){
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail');

        $query = $repository->createQueryBuilder('s')
            ->where('s.language = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $entities = $query->getResult();

        return $this->render('IntoPeopleDatabaseBundle:Systemmail:mailsview.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function changeactiveAction($id){
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('IntoPeopleDatabaseBundle:Mailtype');
        $entity = $repository->find($id);
        if ($entity->getIsActive()){
            $entity->setIsActive(false);
        }else {
            $entity->setIsActive(true);
        }
        $em->flush();
        return new Response();

    }

    /**
     * Finds and displays a Systemmail entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Systemmail entity.');
        }



        return $this->render('IntoPeopleDatabaseBundle:Systemmail:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Systemmail entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Systemmail entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('IntoPeopleDatabaseBundle:Systemmail:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Systemmail entity.
    *
    * @param Systemmail $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Systemmail $entity)
    {
        $form = $this->createForm(new SystemmailType(), $entity, array(
            'action' => $this->generateUrl('systemmail_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Systemmail entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Systemmail entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('systemmail_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Systemmail:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

}
