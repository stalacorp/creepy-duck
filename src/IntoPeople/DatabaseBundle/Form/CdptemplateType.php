<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CdptemplateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isstandardtemplate')
            ->add('selfassesment')
            ->add('selfassesmentDescription')
            ->add('talents')
            ->add('talentsDescription')
            ->add('challenges')
            ->add('challengesDescription')
            ->add('developmentneeds')
            ->add('whatwhy')
            ->add('whatwhyDescription')
            ->add('how')
            ->add('howDescription')
            ->add('success')
            ->add('successDescription')
            ->add('needs')
            ->add('needsDescription')
            ->add('careerobjectives')
            ->add('careerobjectivesQuestion')
            ->add('additionalinformation')
            ->add('additionalinformationQuestion')
            ->add('supervisorComment')
            ->add('feedback')
            ->add('signatureSupervisor')
            ->add('signatureEmployee')
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
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Cdptemplate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_cdptemplate';
    }
}
