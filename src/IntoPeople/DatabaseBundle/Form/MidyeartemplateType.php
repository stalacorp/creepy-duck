<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MidyeartemplateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isstandardtemplate')
            ->add('title1')
            ->add('title2')
            ->add('title3')
            ->add('title4')
            ->add('smallTitle1')
            ->add('smallTitle2')
            ->add('smallTitle3')
            ->add('whatwhy')
            ->add('whatwhydescription')
            ->add('progress')
            ->add('progressdescription')
            ->add('tasks')
            ->add('skills')
            ->add('organization')
            ->add('feedbacksup')
            ->add('feedbacksupdescription')
            ->add('feedbackorganization')
            ->add('feedbackorganizationdescription')
            ->add('language')
            ->add('organization')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Midyeartemplate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_midyeartemplate';
    }
}
