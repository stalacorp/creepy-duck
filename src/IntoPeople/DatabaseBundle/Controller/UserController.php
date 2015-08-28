<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\User;
use IntoPeople\DatabaseBundle\Form\UserType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\EventDispatcher\EventDispatcher,
    Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken,
    Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * User controller.
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     */
    public function indexAction(Request $request)
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
                        $user = $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User')->findOneByEmail($row[0]);
                        if (!$user) {
                            $tokenGenerator = $this->get('fos_user.util.token_generator');
                            $password = substr($tokenGenerator->generateToken(), 0, 10);
                            $user = new User();
                            $user->setEmail($row[0]);
                            $user->setUsername($row[0]);
                            $user->setPlainPassword($password);
                            $user->setEnabled(true);
                            $user->setRoles(array(User::ROLE_DEFAULT));
                            $user->setFirstname($row[1]);
                            $user->setLastname($row[2]);
                            $user->setLanguage($em->getRepository('IntoPeopleDatabaseBundle:Language')->findOneByName($row[3]));

                            $em->persist($user);
                            $em->flush();

                            $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                                ->join('s.mailtype', 'm')
                                ->where('s.language = :id')
                                ->andWhere('m.name = :name')
                                ->setParameter('id', $user->getLanguage())
                                ->setParameter('name', 'usercreated')
                                ->getQuery();

                            $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                            if ($systemmail->getMailtype()->getIsActive()) {
                                $message = \Swift_Message::newInstance()
                                    ->setSubject($systemmail->getSubject())
                                    ->setFrom($systemmail->getSender())
                                    ->setTo($row[0])
                                    ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('user_firstlogin', array('token' => $password, 'id' => $user->getId())), $systemmail->getBody()));

                                $this->get('mailer')->send($message);
                            }
                        }
                    }

                    $count++;
                }
                fclose($handle);


            }catch (Exception $e){
                throw new \Exception($this->get('translator')->trans('user.generateusererror'));
            }
        }

        
        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User');

        $entities = $repository->findAll();

        return $this->render('IntoPeopleDatabaseBundle:User:index.html.twig', array(
            'entities' => $entities,
            'formtemplate' => $form->createView(),
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

        return $this->render('IntoPeopleDatabaseBundle:User:csv.html.twig', array(

        ));


    }

    public function firstloginAction(Request $request, $token, $id){
        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User');

        $user = $repository->find($id);
        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);
        $encoded_pass = $encoder->encodePassword($token, $user->getSalt());
        if ($user && $user->getPassword() == $encoded_pass) {

            $form = $this->createFormBuilder()
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => $this->get('translator')->trans('passwordmatch'),
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'Set Password'),
                    'second_options' => array('label' => 'Repeat Password')))
                ->add('Save', 'submit')
                ->getForm();

            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $user->setPlainPassword($data['password']);
                $this->getDoctrine()->getManager()->flush();
                $token = new UsernamePasswordToken($user, $user->getPassword(), "public", $user->getRoles());
                $this->get("security.context")->setToken($token);

                // Fire the login event
                // Logging the user in above the way we do it doesn't do this automatically
                $event = new InteractiveLoginEvent($request, $token);
                $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

                return $this->redirectToRoute('homepage');

            }
            return $this->render('IntoPeopleDatabaseBundle:User:firstlogin.html.twig', array(
                'form' => $form->createView()
            ));
        }else {
            throw new \Exception($this->get('translator')->trans('firstlogin.error'));
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
