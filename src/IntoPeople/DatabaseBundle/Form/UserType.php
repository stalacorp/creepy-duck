<?php
namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityRepository;


class UserType extends AbstractType
{

    private $tokenStorage;
    
    public function __construct(TokenStorageInterface $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }
    
    /**
     *
     * @param FormBuilderInterface $builder            
     * @param array $options            
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('photo', 'vich_image', array(
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
            ->add('title', 'choice', array(
                'choices' => array(
                    'Mr' => 'Mr',
                    'Mrs' => 'Mrs'
                )
            ))
            ->add('firstname')
            ->add('lastname')
            //->add('username')
            ->add('email', 'email')
            ->add('hiredate', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'format' => 'dd-MM-yyyy',
            ))
            ->add('datelastpromotion', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'format' => 'dd-MM-yyyy',
            ))
            //->add('photo')
            ->add('language')
            //->add('supervisor')
            //->add('policy')
            //->add('role')            
            //->add('employeefunction')
            
            
             ;
            
            
            $user = $this->tokenStorage->getToken()->getUser();
            
            if(!$user) {
                throw new \LogicException('You have to be authenticated!');
            }
            
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($user) {
                $form = $event->getForm();
                $entity = $event->getData();
                
                if ($user->hasRole('ROLE_SUPER_ADMIN')) {
                    $form
                    ->add('organization')
                    ->add('roles', 'choice', array(
                        'choices' => array(
                            'ROLE_USER'   => 'Medewerker',
                            'ROLE_ADMIN' => 'HR / Management',
                            'ROLE_SUPERVISOR' => 'Supervisor',
                            'ROLE_SUPER_ADMIN' => 'Super admin'
                        ), 'multiple' => true));
                    
                    if (!$entity || null === $entity->getId()) {
                        $form->add('supervisor');
                        $form->add('plainpassword', 'password', array('label' => 'Password'));  
                    }

                } else {
                    
                    $form->add('roles', 'choice', array(
                        'choices' => array(
                            'ROLE_USER'   => 'Medewerker',
                            'ROLE_ADMIN' => 'HR / Management',
                            'ROLE_SUPERVISOR' => 'Supervisor',
                        ), 'multiple' => true));
                    
                    if (!$entity || null === $entity->getId()) {
                    
                        $form->add('plainpassword', 'password', array('label' => 'Password'));
                    
                     $formOptions = array(
                        'class' => 'IntoPeople\DatabaseBundle\Entity\User',
                        'query_builder' => function (EntityRepository $er) use ($user) {

                            return $er->createQueryBuilder('p')->where('p.organization = :organization')->setParameter('organization',$user->getOrganization());
                        },
                    );
                    
                    $form
                    ->add('supervisor', 'entity', $formOptions);
                                       

                    }
                }
                                                
                if ($entity->getId() != null) {
                    
                    $formOptions = array(
                        'class' => 'IntoPeople\DatabaseBundle\Entity\User',
                        'query_builder' => function (EntityRepository $er) use ($entity) {

                            return $er->createQueryBuilder('p')->where('p.organization = :organization')->setParameter('organization',$entity->getOrganization());
                        },
                    );
                    
                    $form->add('supervisor', 'entity', $formOptions);
                    
                }               
                             
            });
            
            
            
    }

    /**
     *
     * @param OptionsResolverInterface $resolver            
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\User'
        ));
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_user';
    }
}
