<?php
namespace IntoPeople\DatabaseBundle\Controller;

use IntoPeople\DatabaseBundle\Entity\Corequality;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Cdp;
use IntoPeople\DatabaseBundle\Form\CdpType;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;
use IntoPeople\DatabaseBundle\Entity\Developmentneeds;
use IntoPeople\DatabaseBundle\Entity\Cdphistory;
use Doctrine\ORM\EntityRepository;

/**
 * My cdp controller.
 */
class MyCdpController extends Controller
{

    /**
     * Creates a form to edit a cdp entity.
     *
     * @param Cdp $entity
     *            The entity
     *            
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Cdp $entity)
    {
        $form = $this->createForm(new CdpType(), $entity, array(
            'action' => $this->generateUrl('cdp_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        
        $form
        ->add('save', 'submit', array('label' => 'Save'))
        ->add('saveAndAdd', 'submit', array('label' => 'Save and Submit'));
        
        return $form;
    }

    /**
     * Displays a form to edit an existing Cdp entity.
     */
    public function editAction($id)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);
        $corequalities = $em->getRepository('IntoPeopleDatabaseBundle:Corequality')->findByLanguage($user->getLanguage());
        $user = $this->getUser();
        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }

        if($user != $entity->getFeedbackcycle()->getUser()){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }
        // CAN ONLY FILL IN CDP WHEN STATUS = AVAILABLE OR ...
        //
        
        if ($entity->getFormstatus()->getId() == 1 || $entity->getFormstatus()->getId() == 2 || $entity->getFormstatus()->getId() == 4 || $entity->getFormstatus()->getId() == 7) {
            
            $form = $this->createEditForm($entity);

            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');

            $query = $repository->createQueryBuilder('c')
                ->where('c.templateversion = :cdptemplateversion')
                ->setParameter('cdptemplateversion', $entity->getTemplateversion())
                ->getQuery();

            $template = $query->setMaxResults(1)->getOneOrNullResult();
            
            return $this->render('IntoPeopleDatabaseBundle:Cdp:new.html.twig', array(
                'template' => $template,
                'entity' => $entity,
                'form' => $form->createView(),
                'corequalities' => $corequalities
            ));
        }
        
        return $this->redirect($this->generateUrl('cdp_show', array(
            'id' => $entity->getId()
        )));
    }

    /**
     * Updates a Cdp entity.
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cdp entity.');
        }
        
        $form = $this->createEditForm($entity);

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Formstatus');
            
            if ($form->get('saveAndAdd')->isClicked()) {
                               
                $formstatus = $repository->find(3);
                                             
                // Notification message after organization has been created
                //
                $this->addFlash(
                    'success',
                    'Your Career development plan has been sent to your supervisor!'
                );

                $entity->setDateSubmitted(new \DateTime(date('Y-m-d')));

                $user = $this->getUser();
                $supervisor = $user->getSupervisor();
                $entity->setSupervisor($supervisor);

                if ($supervisor) {
                    $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                        ->join('s.mailtype', 'm')
                        ->where('s.language = :id')
                        ->andWhere('m.name = :name')
                        ->setParameter('id', $supervisor->getLanguage())
                        ->setParameter('name', 'formtosupervisor')
                        ->getQuery();

                    $systemmail = $query->setMaxResults(1)->getOneOrNullResult();
                    if ($systemmail->getMailtype()->getIsActive()) {
                        $message = \Swift_Message::newInstance()
                            ->setSubject($systemmail->getSubject())
                            ->setFrom($systemmail->getSender())
                            ->setTo($supervisor->getEmail())
                            ->setBody(str_replace('$url', 'http://' . $request->getHttpHost() . $this->generateUrl('supervisor_addComment', array('id' => $entity->getId())), $systemmail->getBody()), 'text/html');

                        $this->get('mailer')->send($message);
                    }
                }

            } elseif ($form->get('save')->isClicked()) {

                $formstatus = $repository->find(2);
                                
                // Notification message after organization has been created
                //
                $this->addFlash(
                    'success',
                    'Your changes have been saved!'
                 );
             
            }
            
            $entity->setFormstatus($formstatus);

            $corequalities = array();

            array_push($corequalities, $form['coreQuality1']->getData());
            array_push($corequalities, $form['coreQuality2']->getData());
            array_push($corequalities, $form['coreQuality3']->getData());
            array_push($corequalities, $form['coreQuality4']->getData());
            array_push($corequalities, $form['coreQuality5']->getData());
            $teller = 0;

            foreach ($corequalities as $corequality){
                if ($corequality != '') {
                    $corequalityx = $em->getRepository('IntoPeopleDatabaseBundle:Corequality')->findOneByCoreQuality($corequality);
                    if ($corequalityx == null) {
                        $newcorequality = new Corequality();
                        $newcorequality->setCoreQuality($corequality);
                        $newcorequality->setIsStandard(false);
                        $em->persist($newcorequality);
                        $corequalities[$teller] = $newcorequality;

                    } else {
                        $corequalities[$teller] = $corequalityx;
                    }
                }
                $teller++;
            }

            $entity->setCoreQuality1($corequalities[0]);
            $entity->setCoreQuality2($corequalities[1]);
            $entity->setCoreQuality3($corequalities[2]);
            if ($corequalities[3] != ''){
                $entity->setCoreQuality4($corequalities[3]);
            }
            if ($corequalities[4] != ''){
                $entity->setCoreQuality5($corequalities[4]);
            }


                           
            $em->flush();

            #return new JsonResponse($entity->getId());
                                  
            return $this->redirect($this->generateUrl('myfeedbackcycle', array(
                'id' => $entity->getId()
            )));
        }

        $user = $this->getUser();

        $corequalities = $em->getRepository('IntoPeopleDatabaseBundle:Corequality')->findByLanguage($user->getLanguage());

        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');

        $query = $repository->createQueryBuilder('c')
            ->where('c.templateversion = :cdptemplateversion')
            ->setParameter('cdptemplateversion', $entity->getTemplateversion())
            ->getQuery();

        $template = $query->setMaxResults(1)->getOneOrNullResult();

        return $this->render('IntoPeopleDatabaseBundle:Cdp:new.html.twig', array(
            'corequalities' => $corequalities,
            'template' => $template,
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Finds and displays the Cdp.
     *
     */
    public function showAction($id)
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdp')->find($id);
        $securityContext = $this->container->get('security.context');
        if($this->getUser() != $entity->getFeedbackcycle()->getUser() & !$securityContext->isGranted('ROLE_HR')){
            throw new \Exception($this->get('translator')->trans('noaccesserror'));
        }
    
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');

        $query = $repository->createQueryBuilder('c')
            ->where('c.templateversion = :cdptemplateversion')
            ->andWhere('c.language = :language')
            ->setParameter('cdptemplateversion', $entity->getTemplateversion())
            ->setParameter('language', $user->getLanguage())
            ->getQuery();

        $template = $query->setMaxResults(1)->getOneOrNullResult();
        
        return $this->render('IntoPeopleDatabaseBundle:Cdp:show.html.twig', array(
            'template' => $template,
            'entity' => $entity,
        ));
    }
}