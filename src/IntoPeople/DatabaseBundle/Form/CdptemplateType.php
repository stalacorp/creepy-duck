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
            ->add('mainTitle')
            ->add('title1')
            ->add('title1Description')
            ->add('name')
            ->add('supervisor')
            ->add('dateDiscussion')
            ->add('team')
            ->add('function')
            ->add('title2')
            ->add('title2Description')
            ->add('table2Col1')
            ->add('table2Col1Descr')
            ->add('table2Col2')
            ->add('table2Col2Descr')
            ->add('table2Col3')
            ->add('table2Col3Descr')
            ->add('table2Col4')
            ->add('table2Col4Descr')
            ->add('table2Col5')
            ->add('table2Col5Descr')
            ->add('table2Col6')
            ->add('table2Col6Descr')
            ->add('title3')
            ->add('title3Description')
            ->add('table3Col1')
            ->add('table3Col1Descr')
            ->add('table3Col2')
            ->add('table3Col2Descr')
            ->add('table3Col3')
            ->add('table3Col3Descr')
            ->add('table3Col4')
            ->add('table3Col4Descr')
            ->add('table3Title1')
            ->add('table3Title2')
            ->add('table3Title3')
            ->add('title4')
            ->add('question1')
            ->add('title5')
            ->add('question2')
            ->add('supervisorComment')
            ->add('feedback')
            ->add('signatureSupervisor')
            ->add('signatureEmployee')
            ->add('language')
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
