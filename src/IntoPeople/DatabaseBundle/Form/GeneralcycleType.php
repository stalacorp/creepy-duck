<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GeneralcycleType extends AbstractType
{
    
    private $tokenStorage;
    
    public function __construct(TokenStorageInterface $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year')
            ->add('startdatecdp', 'date', array(
               'widget' => 'single_text',
               'required' => false,
                'label' => 'Start date',
                'format' => 'MM/dd/yyyy',
            ))
            ->add('enddatecdp', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'End date',
                'format' => 'MM/dd/yyyy',
            ))
            ->add('startdatemidyear', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Start date',
                'format' => 'MM/dd/yyyy',
            ))
            ->add('enddatemidyear', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'End date',
                'format' => 'MM/dd/yyyy',
            ))
            ->add('startdateyearend', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Start date',
                'format' => 'MM/dd/yyyy',
            ))
            ->add('enddateyearend', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'End date',
                'format' => 'MM/dd/yyyy',
            ))         
        ;
            
            
            $user = $this->tokenStorage->getToken()->getUser();
            
            if(!$user) {
                throw new \LogicException('You have to be authenticated!');
            }
            
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($user) {
                $form = $event->getForm();
                $entity = $event->getData();
            
                if ($user->hasRole('ROLE_SUPER_ADMIN') && (!$entity || null === $entity->getId())) {
                    $form->add('organization');
                }
            
            });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Generalcycle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_generalcycle';
    }
}
