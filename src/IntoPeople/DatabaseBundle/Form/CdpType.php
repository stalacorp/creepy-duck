<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CdpType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coreQuality1')
            ->add('coreQuality2')
            ->add('coreQuality3')
            ->add('coreQuality4')
            ->add('coreQuality5')
            ->add('coreQuality1Why')
            ->add('coreQuality2Why')
            ->add('coreQuality3Why')
            ->add('coreQuality4Why')
            ->add('coreQuality5Why')
            ->add('challenge1')
            ->add('challenge2')
            ->add('challenge3')
            ->add('challenge4')
            ->add('challenge5')
            ->add('challengeWhy1')
            ->add('challengeWhy2')
            ->add('challengeWhy3')
            ->add('challengeWhy4')
            ->add('challengeWhy5')
            ->add('challengeHow1')
            ->add('challengeHow2')
            ->add('challengeHow3')
            ->add('challengeHow4')
            ->add('challengeHow5')
            ->add('challengeSuccess1')
            ->add('challengeSuccess2')
            ->add('challengeSuccess3')
            ->add('challengeSuccess4')
            ->add('challengeSuccess5')
            ->add('challengeNeeds1')
            ->add('challengeNeeds2')
            ->add('challengeNeeds3')
            ->add('challengeNeeds4')
            ->add('challengeNeeds5')
            ->add('developmentneeds', new DevelopmentneedsType())
            ->add('taskhow1')
            ->add('taskhow2')
            ->add('taskhow3')
            ->add('taskhow4')
            ->add('taskhow5')
            ->add('tasksucces1')
            ->add('tasksucces2')
            ->add('tasksucces3')
            ->add('tasksucces4')
            ->add('tasksucces5')
            ->add('taskneeds1')
            ->add('taskneeds2')
            ->add('taskneeds3')
            ->add('taskneeds4')
            ->add('taskneeds5')
            ->add('skillshow1')
            ->add('skillshow2')
            ->add('skillshow3')
            ->add('skillshow4')
            ->add('skillshow5')
            ->add('skillssuccess1')
            ->add('skillssucces2')
            ->add('skillssucces3')
            ->add('skillssucces4')
            ->add('skillssucces5')
            ->add('skillsneeds1')
            ->add('skillsneeds2')
            ->add('skillsneeds3')
            ->add('skillsneeds4')
            ->add('skillsneeds5')
            ->add('organizationhow1')
            ->add('organizationhow2')
            ->add('organizationhow3')
            ->add('organizationhow4')
            ->add('organizationhow5')
            ->add('organizationsuccess1')
            ->add('organizationsuccess2')
            ->add('organizationsuccess3')
            ->add('organizationsuccess4')
            ->add('organizationsuccess5')
            ->add('organizationneeds1')
            ->add('organizationneeds2')
            ->add('organizationneeds3')
            ->add('organizationneeds4')
            ->add('organizationneeds5')
            ->add('careerobjective')
            ->add('additionalinformation')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Cdp'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_cdp';
    }
}
