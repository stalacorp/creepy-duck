<?php
namespace IntoPeople\DatabaseBundle\Controller;

use IntoPeople\DatabaseBundle\Entity\Jobtitle;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;
use IntoPeople\DatabaseBundle\Entity\Cdp;
use IntoPeople\DatabaseBundle\Entity\Midyear;
use IntoPeople\DatabaseBundle\Entity\Endyear;
use IntoPeople\DatabaseBundle\Entity\Developmentneeds;
use IntoPeople\DatabaseBundle\Form\ProfileFormType;
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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\JsonResponse;

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
            ->add('template', 'file', array('constraints' => array(new File(array('maxSize' => "10M",
                'mimeTypes' => array('application/vnd.ms-office', 'application/vnd.ms-excel'),

            )),
                new NotBlank(array('message' => 'nofileerror'))),
                'required'=> true ))
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
                $version = $em->getRepository('IntoPeopleDatabaseBundle:Templateversion')->findOneByVersion($worksheet->getCell('K4'));

                for ($i = 2; $i <= $highestRow; $i++) {

                    $email = $worksheet->getCell('A' . $i)->getValue();
                    $firstname = $worksheet->getCell('B' . $i)->getValue();
                    $lastname = $worksheet->getCell('C' . $i)->getValue();
                    $jobtitle = $worksheet->getCell('D' . $i)->getValue();
                    $languagekey = $worksheet->getCell('E' . $i)->getValue();
                    $addtoactivecycle = $worksheet->getCell('F' . $i)->getValue();
                    $supervisormail = $worksheet->getCell('G' . $i)->getValue();
                    $issupervisor = $worksheet->getCell('H' . $i)->getValue();
                    $ishr = $worksheet->getCell('I' . $i)->getValue();

                    $emailConstraint = new EmailConstraint();
                    $emailConstraint->message = 'Your customized error message';

                    $errors = $this->get('validator')->validateValue(
                        $email,
                        $emailConstraint
                    );

                    if (count($errors) == 0 & $email != '') {
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

                                if ($jobtitle != '') {

                                    $jobtitleentity = $em->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findOneByName($jobtitle);

                                    if ($jobtitleentity == null) {
                                        $jobtitleentity = new Jobtitle();
                                        $jobtitleentity->setName($jobtitle);
                                        $em->persist($jobtitleentity);
                                    }

                                    $user->setJobtitle($jobtitleentity);
                                }

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
                                    $cdp->setTemplateversion($version);

                                    $feedbackcycle->setCdp($cdp);

                                    $midyear = new Midyear();
                                    $midyear->setDevelopmentneeds($developmentneeds);
                                    $midyear->setFormstatus($unavailable);
                                    $midyear->setMidyeartemplate($midyeartemplate);
                                    $midyear->setTemplateversion($version);

                                    $feedbackcycle->setMidyear($midyear);

                                    $endyear = new Endyear();
                                    $endyear->setDevelopmentneeds($developmentneeds);
                                    $endyear->setFormstatus($unavailable);
                                    $endyear->setEndyeartemplate($endyeartemplate);
                                    $endyear->setTemplateversion($version);

                                    $feedbackcycle->setEndyear($endyear);

                                    $em = $this->getDoctrine()->getManager();
                                    $em->persist($feedbackcycle);
                                }

                                $systemmail = $mails[$user->getLanguage()->getName()];
                                $message = \Swift_Message::newInstance()
                                    ->setSubject($systemmail->getSubject())
                                    ->setFrom($systemmail->getSender())
                                    ->setTo($user->getEmail())
                                    ->setBody(str_replace(array('$url', '$username', '$password'), array('http://' . $request->getHttpHost() . $this->generateUrl('user_firstlogin', array('token' => $password, 'id' => $user->getId())), $user->getEmail(), $password), $systemmail->getBody()));

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
                                    $this->get('translator')->trans('user.invalidlanguageerror') . ' ' . $email
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

    public function excelAction(){
        $em = $this->getDoctrine()->getEntityManager();

        $jobtitles = $em->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findAll();

        $filename = 'templateenglish.xls';
        if ($this->get('request')->getLocale() == 'nl'){
            $filename = 'templatenederlands.xls';
        }

        $path = $this->get('kernel')->getRootDir() . '/../web/assets/excel/' . $filename;
        $formulajobtitle = '"';

        foreach ($jobtitles as $jobtitle){
            $formulajobtitle .= $jobtitle->getName() . ',';
        }

        $formulajobtitle = substr_replace($formulajobtitle, '', strrpos($formulajobtitle, ','), strlen(',')) . '"';

        $languages = $em->getRepository('IntoPeopleDatabaseBundle:Language')->findAll();

        $formulalanguage = '"';

        foreach ($languages as $language){
            $formulalanguage .= $language->getName() . ',';
        }

        $formulalanguage = substr_replace($formulalanguage, '', strrpos($formulalanguage, ','), strlen(',')) . '"';

        $supervisors = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:User')->createQueryBuilder('u')
            ->where('u.roles like :role')
            ->setParameter('role', '%ROLE_SUPERVISOR%')
            ->getQuery()->getResult();

        $formulasupervisor = '"';

        foreach ($supervisors as $supervisor){
            $formulasupervisor .= $supervisor->getEmail() . ',';
        }

        $formulasupervisor = substr_replace($formulasupervisor, '', strrpos($formulasupervisor, ','), strlen(',')) . '"';

        $versions = $em->getRepository('IntoPeopleDatabaseBundle:Templateversion')->findAll();
        $formulaversion = '"';

        foreach ($versions as $version){
            $formulaversion .= $version->getVersion() . ',';
        }

        $formulaversion = substr_replace($formulaversion, '', strrpos($formulaversion, ','), strlen(',')) . '"';


        $inputFileType = \PHPExcel_IOFactory::identify($path);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($path);


        $objPHPExcel->setActiveSheetIndex(0);

        $objValidation = $objPHPExcel->getActiveSheet()->getCell('K4')->getDataValidation();
        $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
        $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
        $objValidation->setAllowBlank(false);
        $objValidation->setShowInputMessage(true);
        $objValidation->setShowErrorMessage(true);
        $objValidation->setShowDropDown(true);
        $objValidation->setErrorTitle('Input error');
        $objValidation->setError('Value is not in list.');
        $objValidation->setPromptTitle('Pick from list');
        $objValidation->setPrompt('Please pick a value from the drop-down.');
        $objValidation->setFormula1($formulaversion);

        $objPHPExcel->getActiveSheet()->setCellValue('K4', $versions[count($versions) - 1]->getVersion());

        for ($i=2;$i<=250;$i++){


            $objValidation = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getDataValidation();
            $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(false);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Pick from list');
            $objValidation->setPrompt('Please pick a value from the drop-down list or enter your own value.');
            $objValidation->setFormula1($formulajobtitle);

            $objValidation = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getDataValidation();
            $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Pick from list');
            $objValidation->setPrompt('Please pick a value from the drop-down list.');
            $objValidation->setFormula1($formulalanguage);

            $objValidation = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getDataValidation();
            $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(true);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(false);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Pick from list');
            $objValidation->setPrompt('Please pick a value from the drop-down list or enter your own value.');
            $objValidation->setFormula1($formulasupervisor);

            $objValidation = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getDataValidation();
            $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(true);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(false);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not allowed.');
            $objValidation->setPromptTitle('x or blank');
            $objValidation->setPrompt('Please enter x or leave blank');
            $objValidation->setFormula1('"x"');

            $objValidation = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getDataValidation();
            $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(true);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(false);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not allowed.');
            $objValidation->setPromptTitle('x or blank');
            $objValidation->setPrompt('Please enter x or leave blank');
            $objValidation->setFormula1('"x"');

            $objValidation = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getDataValidation();
            $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(true);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(false);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not allowed.');
            $objValidation->setPromptTitle('x or blank');
            $objValidation->setPrompt('Please enter x or leave blank');
            $objValidation->setFormula1('"x"');

        }

        $writer = $this->get('phpexcel')->createWriter($objPHPExcel, 'Excel5');
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=' . 'useruploadtemplate' . '.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;
    }

    /**
     * Creates a new User entity.
     */
    public function createAction(Request $request)
    {
        $userManager = $this->container->get('into_people_database.user_manager');


        $user = $this->getUser();
        
        $entity = $userManager->createUser();

        $jobtitles = $this->getDoctrine()->getManager()->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findAll();
        $jobtitles = array_map(function($o) { return $o->getName(); }, $jobtitles);

        
        $form = $this->createCreateForm($entity);

        $form->handleRequest($request);

        $entity->setUsername($entity->getEmail());
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            $jobtitletext = $form['jobtitle']->getData();

            if ($jobtitletext != null) {

                $jobtitle = $em->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findOneByName($jobtitletext);
                if ($jobtitle == null) {
                    $jobtitle = new Jobtitle();
                    $jobtitle->setName($jobtitletext);
                    $em->persist($jobtitle);
                }

                $entity->setJobtitle($jobtitle);
            }


            $userexists = $em->getRepository('IntoPeopleDatabaseBundle:User')->findOneByEmail_canonical(strtolower($entity->getEmail()));

            if ($userexists == null) {


                $tokenGenerator = $this->get('fos_user.util.token_generator');
                $password = substr($tokenGenerator->generateToken(), 0, 10);
                $entity->setPlainPassword($password);

                if ($entity->getOrganization() == null) {
                    $entity->setOrganization($user->getOrganization());
                }

                if ($form['addtocycle']->getData()){
                    $templateversion = $form['templateversion']->getData();


                    $generalcycleactivestatus = $em->getRepository('IntoPeopleDatabaseBundle:Generalcyclestatus')->findOneByName('Active');
                    $generalcycle = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->findOneByGeneralcyclestatus($generalcycleactivestatus);

                    $repository = $em->getRepository('IntoPeopleDatabaseBundle:Formstatus');

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

                    $feedbackcycle = new Feedbackcycle();
                    $feedbackcycle->setUser($entity);
                    $feedbackcycle->setGeneralcycle($generalcycle);

                    $developmentneeds = new Developmentneeds();

                    $cdp = new Cdp();
                    $cdp->setDevelopmentneeds($developmentneeds);
                    $cdp->setFormstatus($available);
                    $cdp->setCdptemplate($cdptemplate);
                    $cdp->setTemplateversion($templateversion);

                    $feedbackcycle->setCdp($cdp);

                    $midyear = new Midyear();
                    $midyear->setDevelopmentneeds($developmentneeds);
                    $midyear->setFormstatus($unavailable);
                    $midyear->setMidyeartemplate($midyeartemplate);
                    $midyear->setTemplateversion($templateversion);

                    $feedbackcycle->setMidyear($midyear);

                    $endyear = new Endyear();
                    $endyear->setDevelopmentneeds($developmentneeds);
                    $endyear->setFormstatus($unavailable);
                    $endyear->setEndyeartemplate($endyeartemplate);
                    $endyear->setTemplateversion($templateversion);

                    $feedbackcycle->setEndyear($endyear);

                    $em->persist($feedbackcycle);
                }

                $em->persist($entity);
                $em->flush();

                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $entity->getLanguage())
                    ->setParameter('name', 'usercreated')
                    ->getQuery();

                $systemmail = $query->setMaxResults(1)->getOneOrNullResult();

                if ($systemmail->getMailtype()->getIsActive()) {
                    $message = \Swift_Message::newInstance()
                        ->setSubject($systemmail->getSubject())
                        ->setFrom($systemmail->getSender())
                        ->setTo($entity->getEmail())
                        ->setBody(str_replace(array('$url', '$username', '$password'), array('http://' . $request->getHttpHost() . $this->generateUrl('user_firstlogin', array('token' => $password, 'id' => $entity->getId())), $entity->getEmail(), $password), $systemmail->getBody()));

                    $this->get('mailer')->send($message);
                }


                return $this->redirect($this->generateUrl('user_show', array(
                    'id' => $entity->getId()
                )));
            }else {
                $tr = $this->get('translator');
                $message = $tr->trans('user.emailalreadyexists');

                $this->addFlash(
                    'danger',
                    $message
                );
            }
        }
        
        return $this->render('IntoPeopleDatabaseBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'jobtitles' => $jobtitles
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
        $locale = $this->get('request')->getLocale();

        $tokenStorage = $this->container->get('security.token_storage');
        $entity->setEnabled(true);
        
        $form = $this->createForm(new UserType($this->get('request')->getLocale()), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST'
        ));
        
        $form->add('submit', 'submit', array(
            'label' => 'Create'
        ))
             ->add('addtocycle','checkbox', array('required'=> false,
             'mapped'=> false))
             ->add('templateversion', 'entity', array(
        'class' => 'IntoPeopleDatabaseBundle:Templateversion',
             'mapped'=> false));
        
        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     */
    public function newAction()
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);

        $jobtitles = $this->getDoctrine()->getManager()->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findAll();
        $jobtitles = array_map(function($o) { return $o->getName(); }, $jobtitles);
        
        return $this->render('IntoPeopleDatabaseBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'jobtitles' => $jobtitles
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

        $form = $this->createForm(new ProfileFormType(), $user);
        $test = 0;
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
                }else {
                    $test = 1;
                    $tr = $this->get('translator');
                    $message = $tr->trans('user.profile.oldpasswordwrong');

                    $this->addFlash(
                        'warning',
                        $message
                    );
                }

            }

            if ($test == 0) {
                $tr = $this->get('translator');
                $message = $tr->trans('notification.user.profile');

                $this->addFlash(
                    'success',
                    $message
                );
            }

            $em->flush();


        }

        return $this->render('IntoPeopleDatabaseBundle:User:profile.html.twig', array(
            'form' => $form->createView(),
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

        $jobtitles = $em->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findAll();
        $jobtitles = array_map(function($o) { return $o->getName(); }, $jobtitles);
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:User')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        if ($entity->getJobtitle() != null){
            $editForm->get('jobtitle')->setData($entity->getJobtitle()->getName());
        }
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:User:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'jobtitles' => $jobtitles
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

        $form = $this->createForm(new UserType($this->get('request')->getLocale()), $entity, array(
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
            $em = $this->getDoctrine()->getEntityManager();

            $jobtitletext = $editForm['jobtitle']->getData();
            if ($jobtitletext != null) {

                $jobtitle = $em->getRepository('IntoPeopleDatabaseBundle:Jobtitle')->findOneByName($jobtitletext);
                if ($jobtitle == null) {
                    $jobtitle = new Jobtitle();
                    $jobtitle->setName($jobtitletext);
                    $em->persist($jobtitle);
                }

                $entity->setJobtitle($jobtitle);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('user'));
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

    public function deleteableAction($id)
    {
        $locale = $this->get('request')->getLocale();
        $ok = 'ok';
        $translator = $this->get('translator');

        $user = $this->getDoctrine()->getManager()->getRepository('IntoPeopleDatabaseBundle:User')->find($id);
        $teller = 0;
        $userstext = '';
        foreach ($user->getUsers() as $superviseduser){
            $userstext .= $superviseduser->getFirstname() . $superviseduser->getLastname() . ', ';
            $teller++;
        }

        if ($teller > 0){
            $userstext = substr($userstext, 0, strlen($userstext) - 2);
            $ok = $translator->trans('user.deleteerror.stillsupervisor') . ' ' . $userstext;
        }

        if (count($user->getFeedbackcycles())> 0){
            $ok = $translator->trans('user.deleteerror.stillfeedbackcycles');
        }

        return new JsonResponse($ok);
    }
}
