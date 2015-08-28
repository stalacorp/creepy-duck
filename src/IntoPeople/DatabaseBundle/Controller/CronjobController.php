<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CronjobController extends Controller
{
    public function cronjobAction(Request $request, $token)
    {
        if ($token == "pke4qvZIrL") {
            $em = $this->getDoctrine()->getManager();

            $query = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->createQueryBuilder('g')
                ->join('g.generalcyclestatus', 's')
                ->where('s.name = :name')
                ->setParameter('name', 'formtosupervisor')
                ->getQuery();
            $generalcycles = $query->getResult();

            $today = new \DateTime(date('Y-m-d'));

            $users = $em->getRepository('IntoPeopleDatabaseBundle:User')->findAll();
            $newcyclemails = array();
            $weekbeforedeadlinemails = array();

            $languages = $em->getRepository('IntoPeopleDatabaseBundle:Language')->findAll();

            foreach ($languages as $language) {
                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $language)
                    ->setParameter('name', 'newcycle')
                    ->getQuery();

                $newyclemails[$language->getName()] = $query->setMaxResults(1)->getOneOrNullResult();

                $query = $em->getRepository('IntoPeopleDatabaseBundle:Systemmail')->createQueryBuilder('s')
                    ->join('s.mailtype', 'm')
                    ->where('s.language = :id')
                    ->andWhere('m.name = :name')
                    ->setParameter('id', $language)
                    ->setParameter('name', 'newcycle')
                    ->getQuery();

                $weekbeforedeadlinemails[$language->getName()] = $query->setMaxResults(1)->getOneOrNullResult();
            }

            foreach ($generalcycles as $generalcycle) {

                // newcyclemail
                if ($generalcycle->getStartdatecdp() == $today | $generalcycle->getStartdatemidyear() == $today | $generalcycle->getStartdateyearend() == $today) {

                    foreach ($users as $user) {
                        $systemmail = $newcyclemails[$user->getLanguage()->getName()];
                        if ($systemmail->getMailtype()->getIsActive()) {
                            $message = \Swift_Message::newInstance()
                                ->setSubject($systemmail->getSubject())
                                ->setFrom($systemmail->getSender())
                                ->setTo($user->getEmail())
                                ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('supervisor_addComment', array('id' => $entity->getId())), $systemmail->getBody()));

                            $this->get('mailer')->send($message);
                        }
                    }
                }

                $sevendaysagointerval = new DateInterval('P7D');
                $sevendaysagointerval->invert = 1;

                foreach ($users as $user) {
                    if ($generalcycle->getEnddatecdp()->add($sevendaysagointerval) == $today) {

                    }

                    if ($generalcycle->getEnddatemidyear()->add($sevendaysagointerval) == $today) {

                    }

                    if ($generalcycle->getEnddateyearend()->add($sevendaysagointerval) == $today) {

                    }
                    $systemmail = $weekbeforedeadlinemails[$user->getLanguage()->getName()];
                    if ($systemmail->getMailtype()->getIsActive()) {
                        $message = \Swift_Message::newInstance()
                            ->setSubject($systemmail->getSubject())
                            ->setFrom($systemmail->getSender())
                            ->setTo($user->getEmail())
                            ->setBody(str_replace('$url', 'https://' . $request->getHttpHost() . $this->generateUrl('supervisor_addComment', array('id' => $entity->getId())), $systemmail->getBody()));

                        $this->get('mailer')->send($message);
                    }
                }

            }
        }
        return new Response();


    }


}
