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
    private $locale;
    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage, $locale) {
        $this->tokenStorage = $tokenStorage;
        $this->locale = $locale;
    }


    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $format = "MM/dd/yyyy";

        if ($this->locale == 'nl'){
            $format = 'dd-MM-yyyy';
        }

        $builder
            ->add('year')
            ->add('startdatecdp', 'date', array(
               'widget' => 'single_text',
               'required' => false,
                'label' => 'Start date',
                'format' => $format,
            ))
            ->add('enddatecdp', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'End date',
                'format' => $format,
            ))
            ->add('startdatemidyear', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Start date',
                'format' => $format,
            ))
            ->add('enddatemidyear', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'End date',
                'format' => $format,
            ))
            ->add('startdateyearend', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Start date',
                'format' => $format,
            ))
            ->add('enddateyearend', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'label' => 'End date',
                'format' => $format,
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
