<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MidyearType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['data']->getFeedbackcycle()->getCdp()->getCoreQuality4() != null) {
            $builder->add('progressChallenge4');
        }

        if ($options['data']->getFeedbackcycle()->getCdp()->getCoreQuality5() != null) {
            $builder->add('progressChallenge5');
        }

        $builder
            ->add('progressChallenge1')
            ->add('progressChallenge2')
            ->add('progressChallenge3')
            ->add('progresstask1')
            ->add('progresstask2')
            ->add('progresstask3')
            ->add('progresstask4')
            ->add('progresstask5')
            ->add('progressskill1')
            ->add('progressskill2')
            ->add('progressskill3')
            ->add('progressskill4')
            ->add('progressskill5')
            ->add('progressorganization1')
            ->add('progressorganization2')
            ->add('progressorganization3')
            ->add('progressorganization4')
            ->add('progressorganization5')
            ->add('feedbacksupervisor')
            ->add('feedbackorganization');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Midyear'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_midyear';
    }
}
