<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Generalcycle;
use IntoPeople\DatabaseBundle\Form\GeneralcycleType;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;
use IntoPeople\DatabaseBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\File;

/**
 * Feedbackcycle controller.
 */
class MyFeedbackcycleController extends Controller
{

    /**
     * Lists all my Feedbackcycle entities.
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('generalcycle', 'entity', array(
                'class' => 'IntoPeopleDatabaseBundle:Generalcycle',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.year', 'ASC');
                },
            ))
            ->getForm();

        $form->handleRequest($request);

        return $this->render('IntoPeopleDatabaseBundle:MyFeedbackcycle:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function getcycleAction($generalcycleid) {

        $user = $this->getUser();

        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Feedbackcycle');

        $query = $repository->createQueryBuilder('f')
            ->addSelect('g')
            ->addSelect('u')
            ->addSelect('c')
            ->addSelect('m')
            ->addSelect('e')
            ->addSelect('cf')
            ->addSelect('mf')
            ->addSelect('ef')
            ->join('f.generalcycle', 'g')
            ->join('f.user','u')
            ->join('f.cdp','c')
            ->join('f.midyear','m')
            ->join('f.endyear','e')
            ->join('c.formstatus','cf')
            ->join('m.formstatus','mf')
            ->join('e.formstatus','ef')
            ->where('f.user = :user')
            ->andWhere('f.generalcycle = :generalcycle')
            ->setParameter('user', $user)
            ->setParameter('generalcycle', $generalcycleid)
            ->getQuery();

        $entity = $query->setMaxResults(1)->getOneOrNullResult();

        return $this->render('IntoPeopleDatabaseBundle:MyFeedbackcycle:getcycleview.html.twig', array(
            'feedbackcycle' => $entity
        ));

    }

    /**
     * Finds and displays a Feedbackcycle entity.
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Generalcycle')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Generalcycle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Generalcycle:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView()
        ));
    }

}
