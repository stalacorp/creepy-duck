<?php

namespace IntoPeople\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IntoPeople\AdminBundle\Entity\Organization;
use IntoPeople\AdminBundle\Form\OrganizationType;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Organization controller.
 *
 * @Route("/")
 */
class OrganizationController extends Controller
{
    private function switchConnection($name){
        $connection = $this->getDoctrine()->getManager('default')->getConnection();
        $params['dbname'] = 'br_' . $name;
        $params['user'] = 'root';
        if ($connection->isConnected()) {
            $connection->close();
        }
        $connection->__construct(
            $params, $connection->getDriver(), $connection->getConfiguration(),
            $connection->getEventManager()
        );

        try {
            $connection->connect();
        } catch (Exception $e) {
            // log and handle exception
        }
    }

    /**
     * Lists all Organization entities.
     *
     * @Route("/", name="")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('admin');

        $entities = $em->getRepository('IntoPeopleAdminBundle:Organization')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Organization entity.
     *
     * @Route("/", name="_create")
     * @Method("POST")
     * @Template("IntoPeopleAdminBundle:Organization:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Organization();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager('admin');
            $em->persist($entity);
            $em->flush();

            // generate database
            $kernel = $this->get('kernel');
            $application = new Application($kernel);
            $application->setAutoExit(false);
            $sql = "create database br_" . $entity->getName();
            $stmt = $this->getDoctrine()->getManager('admin')->getConnection()->prepare($sql);
            $stmt->execute();
            $connection = $this->getDoctrine()->getManager('default')->getConnection();
            $params['dbname'] = 'br_' . $entity->getName();
            $params['user'] = 'root';
            if ($connection->isConnected()) {
                $connection->close();
            }
            $connection->__construct(
                $params, $connection->getDriver(), $connection->getConfiguration(),
                $connection->getEventManager()
            );
            $input = new ArrayInput(array(
                'command' => 'doctrine:database:create',
                '--connection' => 'default',
            ));
            // You can use NullOutput() if you don't need the output
            $output = new BufferedOutput();
            $application->run($input, $output);

            // return the output, don't use if you used NullOutput()
            $content = $output->fetch();

            try {
                $connection->connect();
            } catch (Exception $e) {
                // log and handle exception
            }

            $input = new ArrayInput(array(
                'command' => 'doctrine:schema:update',
                '--em' => 'default',
                '--force' => true,
            ));
            // You can use NullOutput() if you don't need the output
            $application->run($input, $output);
            $input = new ArrayInput(array(
                'command' => 'doctrine:fixtures:load',
                '--em' => 'default',
                '--no-interaction' => true,
            ));
            $application->run($input, $output);


            // return the output, don't use if you used NullOutput()
            $content = $output->fetch();

            dump($content);die();

            return $this->redirect($this->generateUrl('_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Organization entity.
     *
     * @param Organization $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Organization $entity)
    {
        $form = $this->createForm(new OrganizationType(), $entity, array(
            'action' => $this->generateUrl('_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Organization entity.
     *
     * @Route("/new", name="_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Organization();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Organization entity.
     *
     * @Route("/{id}", name="_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager('admin');

        $entity = $em->getRepository('IntoPeopleAdminBundle:Organization', 'admin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Organization entity.
     *
     * @Route("/{id}/edit", name="_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager('admin');

        $entity = $em->getRepository('IntoPeopleAdminBundle:Organization', 'admin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Organization entity.
    *
    * @param Organization $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Organization $entity)
    {
        $form = $this->createForm(new OrganizationType(), $entity, array(
            'action' => $this->generateUrl('_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}", name="_update")
     * @Method("PUT")
     * @Template("IntoPeopleAdminBundle:Organization:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('admin');

        $entity = $em->getRepository('IntoPeopleAdminBundle:Organization', 'admin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

}
