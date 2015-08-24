<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FeedbackcycleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('generalcycle')
            ->add('person')
            ->add('cdp', new CdpFormstatusType())
            ->add('midyear', new MidyearFormstatusType())
            ->add('endyear', new EndyearFormstatusType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Feedbackcycle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_feedbackcycle';
    }
}
