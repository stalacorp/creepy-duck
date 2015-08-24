<?php
namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IntoPeople\DatabaseBundle\Entity\Generalcycle;
use IntoPeople\DatabaseBundle\Form\GeneralcycleType;
use IntoPeople\DatabaseBundle\Entity\Feedbackcycle;
use IntoPeople\DatabaseBundle\Entity\Person;

/**
 * Feedbackcycle controller.
 */
class MyFeedbackcycleController extends Controller
{

    /**
     * Lists all my Feedbackcycle entities.
     */
    public function indexAction()
    {
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();

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
            ->setParameter('user', $user)
            ->getQuery();
        
        $entities = $query->getResult();

        return $this->render('IntoPeopleDatabaseBundle:MyFeedbackcycle:index.html.twig', array(
            'entities' => $entities
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
