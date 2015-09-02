<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CronjobController extends Controller
{
    public function cronjobAction(Request $request, $token)
    {
        if ($token == "pke4qvZIrL") {
            $em = $this->getDoctrine()->getManager();

            $query = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->createQueryBuilder('g')
                ->join('g.generalcyclestatus', 's')
                ->where('s.name = :name')
                ->setParameter('name', 'Active')
                ->getQuery();
            $generalcycles = $query->getResult();

            $today = new \DateTime(date('Y-m-d'));

            $users = $em->getRepository('IntoPeopleDatabaseBundle:User')->findAll();
            $newcyclemails = array();
            $weekbeforedeadlinemails = array();

            $languages = $em->getRepository('IntoPeopleDatabaseBundle:Language')->findAll();
            $querynewcycle = $em->getRepository('IntoPeopleDatabaseBundle:Mailtype')->createQueryBuilder('m')
                ->where('m.name = :name')
                ->setParameter('name', 'newcycle')
                ->getQuery();
            $queryweekbeforedeadline = $em->getRepository('IntoPeopleDatabaseBundle:Mailtype')->createQueryBuilder('m')
                ->where('m.name = :name')
                ->setParameter('name', 'weekbeforedeadline')
                ->getQuery();

            if ($querynewcycle->setMaxResults(1)->getOneOrNullResult()->getIsActive()) {

                foreach ($languages as $language) {
                    $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                        ->join('s.mailtype', 'm')
                        ->where('s.language = :id')
                        ->andWhere('m.name = :name')
                        ->setParameter('id', $language)
                        ->setParameter('name', 'newcycle')
                        ->getQuery();

                    $newcyclemails[$language->getName()] = $query->setMaxResults(1)->getOneOrNullResult();
                }

                foreach ($generalcycles as $generalcycle) {

                    // newcyclemail

                    if ($generalcycle->getStartdatecdp() == $today | $generalcycle->getStartdatemidyear() == $today | $generalcycle->getStartdateyearend() == $today) {

                        foreach ($users as $user) {
                            $systemmail = $newcyclemails[$user->getLanguage()->getName()];

                            $message = \Swift_Message::newInstance()
                                ->setSubject($systemmail->getSubject())
                                ->setFrom($systemmail->getSender())
                                ->setTo($user->getEmail())
                                ->setBody($systemmail->getBody());

                            $this->get('mailer')->send($message);

                        }
                    }
                }
            }

            $beforedeadlinemail = $queryweekbeforedeadline->setMaxResults(1)->getOneOrNullResult();
            if ($beforedeadlinemail->getIsActive()){
                foreach ($languages as $language) {
                    $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                        ->join('s.mailtype', 'm')
                        ->where('s.language = :id')
                        ->andWhere('m.name = :name')
                        ->setParameter('id', $language)
                        ->setParameter('name', 'weekbeforedeadline')
                        ->getQuery();

                    $weekbeforedeadlinemails[$language->getName()] = $query->setMaxResults(1)->getOneOrNullResult();
                }
                $sevendaysagointerval = new \DateInterval('P' . $beforedeadlinemail->getMailtype()->getReminderdays() . 'D');
                $sevendaysagointerval->invert = 1;
                foreach ($generalcycles as $generalcycle) {

                    $enddatecdp = $generalcycle->getEnddatecdp()->add($sevendaysagointerval);
                    $enddatemidyear = $generalcycle->getEnddatemidyear()->add($sevendaysagointerval);
                    $enddateyearend = $generalcycle->getEnddateyearend()->add($sevendaysagointerval);

                    if ($enddatecdp == $today | $enddatemidyear  == $today | $enddateyearend == $today) {
                        foreach ($users as $user) {
                            $query = $em->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle')->createQueryBuilder('f')
                                ->where('f.user = :user')
                                ->andWhere('f.generalcycle = :generalcycle')
                                ->setParameter('user', $user)
                                ->setParameter('generalcycle', $generalcycle)
                                ->getQuery();


                            $feedbackcycle = $query->setMaxResults(1)->getOneOrNullResult();

                            if ($enddatecdp == $today) {
                                $cdp = $feedbackcycle->getCdp();
                                $formstatus = $cdp->getFormstatus();
                            }

                            if ($enddatemidyear == $today) {
                                $midyear = $feedbackcycle->getMidyear();
                                $formstatus = $midyear->getFormstatus();
                            }

                            if ($enddateyearend == $today) {
                                $endyear = $feedbackcycle->getEndyear();
                                $formstatus = $endyear->getFormstatus();
                            }

                            $mailusers = array();
                            $formstatusid = $formstatus->getId();
                            if ($formstatusid == 1 | $formstatusid == 2 | $formstatusid == 4){
                                $mailusers[0] = $user;
                            }elseif ($formstatusid == 3){
                                $mailusers[0] = $user->getSupervisor();
                            }elseif ($formstatusid == 5){
                                $query = $em->getRepository('IntoPeopleDatabaseBundle:User')->createQueryBuilder('u')
                                    ->where('u.roles like :role')
                                    ->setParameter(':role', '%ROLE_HR%')
                                    ->getQuery();


                                $users = $query->getResult();

                            }

                            foreach ($mailusers as $mailuser) {
                                $systemmail = $weekbeforedeadlinemails[$mailuser->getLanguage()->getName()];
                                $message = \Swift_Message::newInstance()
                                    ->setSubject($systemmail->getSubject())
                                    ->setFrom($systemmail->getSender())
                                    ->setTo($mailuser->getEmail())
                                    ->setBody($systemmail->getBody());

                                $this->get('mailer')->send($message);
                            }

                        }
                    }
                }
            }
        }

        return new Response();


    }


}
