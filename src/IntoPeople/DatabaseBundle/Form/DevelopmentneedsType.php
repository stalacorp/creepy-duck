<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DevelopmentneedsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task1')
            ->add('task2')
            ->add('task3')
            ->add('task4')
            ->add('task5')
            ->add('skill1')
            ->add('skill2')
            ->add('skill3')
            ->add('skill4')
            ->add('skill5')
            ->add('organizationcompetence1')
            ->add('organizationcompetence2')
            ->add('organizationcompetence3')
            ->add('organizationcompetence4')
            ->add('organizationcompetence5')
            ->add('organizationdescription1')
            ->add('organizationdescription2')
            ->add('organizationdescription3')
            ->add('organizationdescription4')
            ->add('organizationdescription5')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Developmentneeds'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_developmentneeds';
    }
}
