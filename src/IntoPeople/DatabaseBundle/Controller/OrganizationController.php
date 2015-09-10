<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Organization;
use IntoPeople\DatabaseBundle\Form\OrganizationType;
use IntoPeople\DatabaseBundle\Entity\Person;

/**
 * Organization controller.
 */
class OrganizationController extends Controller
{

    /**
     * Lists all Organization entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('IntoPeopleDatabaseBundle:Organization')->findAll();
        
        return $this->render('IntoPeopleDatabaseBundle:Organization:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Creates a new Organization entity.
     */
    public function createAction(Request $request)
    {
        $entity = new Organization();
        $person = new Person();
        $person->setEnabled(true);
        $person->addRole('ROLE_ADMIN');
        $person->addRole('ROLE_SUPERVISOR');
        $person->setOrganization($entity);
        $entity->addPerson($person);
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
                       
            $user = $this->getuser();
            
            $em = $this->getDoctrine()->getManager();
            
            // Date now
            // ---            
            $dt = new \DateTime();
            
            $em->persist($entity);
            $em->flush();
            
            // Notification message after organization has been created
            //
            $this->addFlash(
                'success',
                'You\'ve succesfully created an organization!'
            );
            
            return $this->redirect($this->generateUrl('organization', array(
                'id' => $entity->getId()
            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:Organization:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Organization entity.
     *
     * @param Organization $entity
     *            The entity
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Organization $entity)
    {
        $form = $this->createForm(new OrganizationType(), $entity, array(
            'action' => $this->generateUrl('organization_create'),
            'method' => 'POST'
        ));
        
        $form->add('submit', 'submit', array(
            'label' => 'Create'
        ));
        
        return $form;
    }

    /**
     * Displays a form to create a new Organization entity.
     */
    public function newAction()
    {
        $entity = new Organization();
        
        $person = new Person();
        $person->setEnabled(true);
        $person->addRole('ROLE_ADMIN');
        
        $entity->getPersons()->add($person);
        
        $form = $this->createCreateForm($entity);
        
        return $this->render('IntoPeopleDatabaseBundle:Organization:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a Organization entity.
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Organization')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('IntoPeopleDatabaseBundle:Organization:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Organization entity.
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Organization')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }
        
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('IntoPeopleDatabaseBundle:Organization:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Creates a form to edit a Organization entity.
     *
     * @param Organization $entity
     *            The entity
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Organization $entity)
    {
        $form = $this->createForm(new OrganizationType(), $entity, array(
            'action' => $this->generateUrl('organization_update', array(
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
     * Edits an existing Organization entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Organization')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();
            
            // Notification message after organization has been created
            //
            $this->addFlash(
                'success',
                'You\'ve succesfully updated the organization!'
            );
            
            return $this->redirect($this->generateUrl('organization_edit', array(
                'id' => $id
            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:Organization:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Deletes a Organization entity.
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Organization')->find($id);
            
            if (! $entity) {
                throw $this->createNotFoundException('Unable to find Organization entity.');
            }
            
            $em->remove($entity);
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('organization'));
    }

    /**
     * Creates a form to delete a Organization entity by id.
     *
     * @param mixed $id
     *            The entity id
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organization_delete', array(
            'id' => $id
        )))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
            'label' => 'Delete'
        ))
            ->getForm();
    }
}
