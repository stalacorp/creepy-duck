<?php
namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('oldpassword', 'password', array('mapped' => false,
                'required' => false))
            ->add('newpassword', 'repeated', array(
                'type' => 'password',
                'mapped' => false,
                'invalid_message' => 'user.profile.passwordmatch',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => false))
            ->add('language', 'entity',array(
                'class' => 'IntoPeopleDatabaseBundle:Language'))
            ->add('Save', 'submit');

    }




    public function getName()
    {
        return 'user_profile';
    }


}
