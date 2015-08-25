<?php

namespace IntoPeople\DatabaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IntoPeople\DatabaseBundle\Entity\Cdptemplate;
use IntoPeople\DatabaseBundle\Form\CdptemplateType;

/**
 * Cdptemplate controller.
 *
 */
class CdptemplateController extends Controller
{

    /**
     * Lists all Cdptemplate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntoPeopleDatabaseBundle:Cdptemplate')->findAll();

        return $this->render('IntoPeopleDatabaseBundle:Cdptemplate:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Cdptemplate entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Cdptemplate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $user = $this->getUser();
            
            // Date is current date
            // ---
            $dt = new \DateTime();
            $dt->format('Y-m-d');
            $entity->setDate($dt);
            
            // If standard = true, then the last standard template must be changed to not standard
            // ---
            if ($entity->getIsstandardtemplate() == true) {
                
                $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');
            
                $em = $this->getDoctrine()->getManager();
                $qb = $em->createQueryBuilder();
            
                $qb = $repository->createQueryBuilder('c')
                    ->where('c.isstandardtemplate = :standard ')
                    ->andWhere('c.language = :language')
                    ->setParameter('standard', 1)
                    ->setParameter('language', $entity->getLanguage())
                    ->getQuery();
            
                $oldStandard = $qb->setMaxResults(1)->getOneOrNullResult();
            
                if($oldStandard != null) {
                    
                    $oldStandard->setIsstandardtemplate(0);
                    
                }                             
                
            }
            
            
            // Find all cdps of the company and change cdptemplate 
            // ---
            $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdp');
            
            $em = $this->getDoctrine()->getManager();
            $qb = $em->createQueryBuilder();
            
            $qb = $repository->createQueryBuilder('c')
            ->join('c.feedbackcycle', 'f')
            ->join('f.generalcycle', 'g')
            ->join('f.person', 'p')
            ->where('g.organization = :organization')
            ->andWhere('g.generalcyclestatus = :active')
            ->andWhere($qb->expr()->orX($qb->expr()->eq('c.formstatus', 1),$qb->expr()->eq('c.formstatus', 8)))
            ->setParameter('organization', $user->getOrganization())
            ->setParameter('active', 1)
            ->getQuery();
            
            $cdps = $qb->getResult();
              
            foreach($cdps as $cdp) {
                $cdp->setCdptemplate($entity);
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cdptemplate_show', array('id' => $entity->getId())));
        }

        return $this->render('IntoPeopleDatabaseBundle:Cdptemplate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Cdptemplate entity.
     *
     * @param Cdptemplate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cdptemplate $entity)
    {
        $form = $this->createForm(new CdptemplateType(), $entity, array(
            'action' => $this->generateUrl('cdptemplate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cdptemplate entity.
     *
     */
    public function newAction()
    {
        $repository = $this->getDoctrine()->getRepository('IntoPeopleDatabaseBundle:Cdptemplate');
            
            $qb = $repository->createQueryBuilder('c')
            ->where('c.isstandardtemplate = :template')
            ->andWhere('c.language = :language')
            ->setParameter('template', 1)
            ->setParameter('language', 1)
            ->getQuery();
            
        $entity = $qb->setMaxResults(1)->getOneOrNullResult();
        
        if ($entity == null) {
            $entity = new Cdptemplate();
        }
        
        $form   = $this->createCreateForm($entity);

        return $this->render('IntoPeopleDatabaseBundle:Cdptemplate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cdptemplate entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdptemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cdptemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Cdptemplate:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cdptemplate entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdptemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cdptemplate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntoPeopleDatabaseBundle:Cdptemplate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Cdptemplate entity.
    *
    * @param Cdptemplate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cdptemplate $entity)
    {
        $form = $this->createForm(new CdptemplateType(), $entity, array(
            'action' => $this->generateUrl('cdptemplate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cdptemplate entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdptemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cdptemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cdptemplate_edit', array('id' => $id)));
        }

        return $this->render('IntoPeopleDatabaseBundle:Cdptemplate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cdptemplate entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IntoPeopleDatabaseBundle:Cdptemplate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cdptemplate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cdptemplate'));
    }

    /**
     * Creates a form to delete a Cdptemplate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cdptemplate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
