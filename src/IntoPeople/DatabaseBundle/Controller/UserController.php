<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\User;
use IntoPeople\DatabaseBundle\Form\UserType;
use Symfony\Component\Validator\Constraints\File;

/**
 * User controller.
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User');

        $entities = $repository->findAll();

        return $this->render('IntoPeopleDatabaseBundle:User:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Creates a new User entity.
     */
    public function createAction(Request $request)
    {
        $userManager = $this->container->get('into_people_database.user_manager');
        
        $user = $this->getUser();
        
        $entity = $userManager->createUser();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        $entity->setEnabled(true);
        
        if ($form->isValid()) {
            if($entity->getOrganization() == null) {
                $entity->setOrganization($user->getOrganization());
            }
                      
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('user_show', array(
                'id' => $entity->getId()
            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity
     *            The entity
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $tokenStorage = $this->container->get('security.token_storage');
        
        $form = $this->createForm(new UserType($tokenStorage), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST'
        ));
        
        $form->add('submit', 'submit', array(
            'label' => 'Create'
        ));
        
        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     */
    public function newAction()
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        
        return $this->render('IntoPeopleDatabaseBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    public function csvAction(Request $request)
    {
        $defaultData = array();
        $form = $this->createFormBuilder($defaultData)
            ->add('template', 'file',array('constraints' => new File(array('maxSize' => "10M",
                'mimeTypes' => array('application/vnd.ms-excel', 'text/plain'),
            ))))
            ->add('create users', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $count = 0;
            try {
                $handle = fopen($data['template'], "r");
                while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $row = array_map("utf8_encode", $row);
                    if ($count != 0) {
                        $tokenGenerator = $this->get('fos_user.util.token_generator');
                        $password = substr($tokenGenerator->generateToken(), 0, 10);
                        $user = new User();
                        $user->setEmail($row[0]);
                        $user->setUsername($row[0]);
                        $user->setPlainPassword($password);
                        dump($password);
                        $user->setEnabled(true);
                        $user->setRoles(array(User::ROLE_DEFAULT));
                        $user->setFirstname($row[1]);
                        $user->setLastname($row[2]);

                        $em->persist($user);
                    }

                    $count++;
                }
                fclose($handle);
                $em->flush();

                return $this->render('IntoPeopleDatabaseBundle:User:csv.html.twig', array(
                    'form' => $form->createView()
                ));
            }catch (Exception $e){

            }
            }


    }

    /**
     * Finds and displays a User entity.
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:User')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('IntoPeopleDatabaseBundle:User:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:User')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('IntoPeopleDatabaseBundle:User:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $entity
     *            The entity
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $entity)
    {
        $tokenStorage = $this->container->get('security.token_storage');
        
        $form = $this->createForm(new UserType($tokenStorage), $entity, array(
            'action' => $this->generateUrl('user_update', array(
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
     * Edits an existing User entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:User')->find($id);
        
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();
            
            return $this->redirect($this->generateUrl('user_edit', array(
                'id' => $id
            )));
        }
        
        return $this->render('IntoPeopleDatabaseBundle:User:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Deletes a User entity.
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:User')->find($id);
            
            if (! $entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }
            
            $em->remove($entity);
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id
     *            The entity id
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array(
            'id' => $id
        )))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
            'label' => 'Delete'
        ))
            ->getForm();
    }
}
