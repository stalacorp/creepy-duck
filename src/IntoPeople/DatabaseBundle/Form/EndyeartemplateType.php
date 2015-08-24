<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EndyeartemplateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isstandardtemplate')
            ->add('whatwhy')
            ->add('whatwhydescription')
            ->add('evaluation')
            ->add('evaluationdescription')
            ->add('tasks')
            ->add('skills')
            ->add('organization')
            ->add('feedbackorganization')
            ->add('feedbackorganizationdescription1')
            ->add('feedbackorganizationdescription2')
            ->add('feedbackorganizationdescription3')
            ->add('feedbackorganizationdescription4')
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
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Endyeartemplate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_endyeartemplate';
    }
}
