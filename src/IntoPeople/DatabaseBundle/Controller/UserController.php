<?php
namespace IntoPeople\DatabaseBundle\Controller;

use IntoPeople\DatabaseBundle\Entity\Jobtitle;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;
use IntoPeople\DatabaseBundle\Entity\Cdp;
use IntoPeople\DatabaseBundle\Entity\Midyear;
use IntoPeople\DatabaseBundle\Entity\Endyear;
use IntoPeople\DatabaseBundle\Entity\Developmentneeds;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\User;
use IntoPeople\DatabaseBundle\Form\UserType;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\EventDispatcher\EventDispatcher,
    Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken,
    Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Validator\Constraints\Email as EmailConstraint;

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
                'mimeTypes' => array('application/vnd.ms-office'),
            ))))
            ->add('create users', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $languages = $em->getRepository('IntoPeopleDatabaseBundle:Language')->findAll();
            $mails = array();

            foreach ($languages as $language){
                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $language)
                    ->setParameter('name', 'usercreated')
                    ->getQuery();

                $mails[$language->getName()] = $query->setMaxResults(1)->getOneOrNullResult();
            }

            $filereadablecheck = '';

            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            try {
                $objPHPExcel = $objReader->load($data['template']);
            }catch (Exception $e){
                $filereadablecheck = "no";
                $this->addFlash(
                    'warning',
                    $this->get('translator')->trans('user.readexcelfileerror')
                );
            }

            if ($filereadablecheck != "no") {

                $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

                $worksheet = $objPHPExcel->getActiveSheet();

                $generalcycleactivestatus = $em->getRepository('IntoPeopleDatabaseBundle:Generalcyclestatus')->findOneByName('Active');
                $generalcycle = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->findOneByGeneralcyclestatus($generalcycleactivestatus);

                $unsupervisedusers = array();

                for ($i = 2; $i <= $highestRow; $i++) {

                    $email = $worksheet->getCell('A' . $i)->getValue();
                    $firstname = $worksheet->getCell('B' . $i)->getValue();
                    $lastname = $worksheet->getCell('C' . $i)->getValue();
                    $languagekey = $worksheet->getCell('D' . $i)->getValue();
                    $addtoactivecycle = $worksheet->getCell('E' . $i)->getValue();
                    $supervisormail = $worksheet->getCell('F' . $i)->getValue();
                    $issupervisor = $worksheet->getCell('G' . $i)->getValue();
                    $ishr = $worksheet->getCell('H' . $i)->getValue();

                    $emailConstraint = new EmailConstraint();
                    $emailConstraint->message = 'Your customized error message';

                    $errors = $this->get('validator')->validateValue(
                        $email,
                        $emailConstraint
                    );

                    if (count($errors) == 0) {
                        $user = $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User')->findOneByEmail($email);
                        if (!$user) {
                            $tokenGenerator = $this->get('fos_user.util.token_generator');
                            $password = substr($tokenGenerator->generateToken(), 0, 10);
                            $user = new User();
                            $user->setEmail($email);
                            $user->setUsername($email);
                            $user->setPlainPassword($password);
                            $user->setEnabled(true);
                            $user->setRoles(array(User::ROLE_DEFAULT));
                            $user->setFirstname($firstname);
                            $user->setLastname($lastname);

                            $language = $em->getRepository('IntoPeopleDatabaseBundle:Language')->findOneByName($languagekey);
                            if ($language != null) {

                                $user->setLanguage($language);

                                if ($issupervisor == 'x') {
                                    $user->addRole('ROLE_SUPERVISOR');
                                }
                                if ($ishr == 'x') {
                                    $user->addRole('ROLE_HR');
                                }


                                $em->persist($user);
                                $em->flush();


                                $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');

                                $available = $repository->find(1);
                                $unavailable = $repository->find(9);

                                // FIND NEWEST CDP TEMPLATE
                                // ---
                                $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');

                                $cdptemplate = $repository->findNewest();

                                // FIND NEWEST MID YEAR TEMPLATE
                                // ---
                                $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Midyeartemplate');

                                $midyeartemplate = $repository->findNewest();

                                // FIND NEWEST END YEAR TEMPLATE
                                // ---
                                $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Endyeartemplate');

                                $endyeartemplate = $repository->findNewest();
                                if ($addtoactivecycle == 'x') {

                                    $feedbackcycle = new Feedbackcycle();
                                    $feedbackcycle->setUser($user);
                                    $feedbackcycle->setGeneralcycle($generalcycle);

                                    $developmentneeds = new Developmentneeds();

                                    $cdp = new Cdp();
                                    $cdp->setDevelopmentneeds($developmentneeds);
                                    $cdp->setFormstatus($available);
                                    $cdp->setCdptemplate($cdptemplate);

                                    $feedbackcycle->setCdp($cdp);

                                    $midyear = new Midyear();
                                    $midyear->setDevelopmentneeds($developmentneeds);
                                    $midyear->setFormstatus($unavailable);
                                    $midyear->setMidyeartemplate($midyeartemplate);

                                    $feedbackcycle->setMidyear($midyear);

                                    $endyear = new Endyear();
                                    $endyear->setDevelopmentneeds($developmentneeds);
                                    $endyear->setFormstatus($unavailable);
                                    $endyear->setEndyeartemplate($endyeartemplate);

                                    $feedbackcycle->setEndyear($endyear);

                                    $em = $this->getDoctrine()->getManager();
                                    $em->persist($feedbackcycle);
                                }

                                $systemmail = $mails[$user->getLanguage()->getName()];
                                $message = \Swift_Message::newInstance()
                                    ->setSubject($systemmail->getSubject())
                                    ->setFrom($systemmail->getSender())
                                    ->setTo($user->getEmail())
                                    ->setBody(str_replace(array('$url', '$username', '$password'), array('https://' . $request->getHttpHost() . $this->generateUrl('user_firstlogin', array('token' => $password, 'id' => $user->getId())), $user->getEmail(), $password), $systemmail->getBody()));

                                $this->get('mailer')->send($message);



                                if ($supervisormail != '') {
                                    $unsuperviseduser = new \stdClass();
                                    $unsuperviseduser->supervisormail = $supervisormail;
                                    $unsuperviseduser->usermail = $user->getEmail();
                                    array_push($unsupervisedusers, $unsuperviseduser);
                                }
                            } else {
                                $this->addFlash(
                                    'warning',
                                    $this->get('translator')->trans('user.invalidlanguageerror')
                                );
                            }
                        }


                    }


                }

                foreach ($unsupervisedusers as $unsuperviseduser){
                    $user = $em->getRepository('IntoPeopleDatabaseBundle:User')->findOneByEmail($unsuperviseduser->usermail);
                    $supervisor = $em->getRepository('IntoPeopleDatabaseBundle:User')->findOneByEmail($unsuperviseduser->supervisormail);
                    if ($supervisor != null) {
                        $user->setSupervisor($supervisor);
                    }else {
                        $translated = $this->get('translator')->trans(
                            'Setting supervisor with email %supervisoremail% for user %name%, supervisor does not exist.',
                            array('%name%' => $user->getFirstname() . ' ' . $user->getLastname(), '%supervisoremail%' => $unsuperviseduser->supervisormail)
                        );
                        $this->addFlash(
                            'warning',
                            $translated
                        );
                    }
                }


                $em->flush();
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
            $em = $this->getDoctrine()->getEntityManager();

            $tokenGenerator = $this->get('fos_user.util.token_generator');
            $password = substr($tokenGenerator->generateToken(), 0, 10);
            $entity->setPlainPassword($password);

            if($entity->getOrganization() == null) {
                $entity->setOrganization($user->getOrganization());
            }

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
                    ->setTo($entity->getEmail())
                    ->setBody(str_replace(array('$url', '$username', '$password'), array('https://' . $request->getHttpHost() . $this->generateUrl('user_firstlogin', array('token' => $password, 'id' => $user->getId())), $user->getEmail(), $password), $systemmail->getBody()));

                $this->get('mailer')->send($message);
            }

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

            $form = $this->createFormBuilder($user)
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => $this->get('translator')->trans('passwordmatch'),
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'Set Password'),
                    'second_options' => array('label' => 'Repeat Password')))
                ->add('language', 'entity',array(
                    'class' => 'IntoPeopleDatabaseBundle:Language'))
                ->add('Save', 'submit')
                ->getForm();

            $form->handleRequest($request);
            if ($form->isValid()) {
                $user->setPlainPassword($user->getPassword());
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

    public function profileAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);


        $entities = $em->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findAll();
        $jobtitles = array_map(create_function('$o', 'return $o->getName();'), $entities);



        $form = $this->createFormBuilder($user)
            ->add('firstname')
            ->add('lastname')
            ->add('jobtitle', 'text', array('mapped' => false,
                'attr'   =>  array('class'   => 'typeahead')
            ))
            ->add('oldpassword', 'password', array('mapped' => false,
                'required' => false))
            ->add('newpassword', 'repeated', array(
                'type' => 'password',
                'mapped' => false,
                'invalid_message' => $this->get('translator')->trans('passwordmatch'),
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => false,
                'first_options' => array('label' => 'Set new Password'),
                'second_options' => array('label' => 'Repeat new Password')))
            ->add('language', 'entity',array(
                'class' => 'IntoPeopleDatabaseBundle:Language'))
            ->add('Save', 'submit')
            ->getForm();
        $form['jobtitle']->setData($user->getJobtitle()->getName());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $userManager = $this->get('fos_user.user_manager');
            $oldpassword = $form->get('oldpassword')->getData();
            $newpassword = $form->get('newpassword')->getData();
            if ($oldpassword != null & $newpassword != null){
                $encoded_pass = $encoder->encodePassword($oldpassword, $user->getSalt());
                if ($user->getPassword() == $encoded_pass){
                    $user->setPlainPassword($newpassword);
                    $userManager->updateUser($user);
                }

            }

            $jobtitle = $em->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findOneByName($form->get('jobtitle')->getData());

            if ($jobtitle == null) {
                $jobtitle = new Jobtitle();
                $jobtitle->setName($form->get('jobtitle')->getData());
                $em->persist($jobtitle);
            }

            $user->setJobtitle($jobtitle);


            // Notification message after Core Quality has been created
            //
            $tr = $this->get('translator');
            $message = $tr->trans('notification.user.profile');

            $this->addFlash(
                'success',
                $message
            );

            $em->flush();


        }
        return $this->render('IntoPeopleDatabaseBundle:User:profile.html.twig', array(
            'form' => $form->createView(),
            'jobtitles' => $jobtitles
        ));
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
}
