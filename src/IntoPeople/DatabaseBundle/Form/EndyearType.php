<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EndyearType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('evaluationtask1')
            ->add('evaluationtask2')
            ->add('evaluationtask3')
            ->add('evaluationtask4')
            ->add('evaluationtask5')
            ->add('evaluationskill1')
            ->add('evaluationskill2')
            ->add('evaluationskill3')
            ->add('evaluationskill4')
            ->add('evaluationskill5')
            ->add('evaluationorganization1')
            ->add('evaluationorganization2')
            ->add('evaluationorganization3')
            ->add('evaluationorganization4')
            ->add('evaluationorganization5')
            ->add('feedbackorganization1')
            ->add('feedbackorganization2')
            ->add('feedbackorganization3')
            ->add('feedbackorganization4')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Endyear'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_endyear';
    }
}
