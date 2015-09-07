<?php
namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Model\User;

class PersonOrganizationType extends AbstractType
{

    /**
     *
     * @param FormBuilderInterface $builder            
     * @param array $options            
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('title', 'choice', array(
                'choices' => array(
                    'Mr' => 'Mr',
                    'Mrs' => 'Mrs'
                )
            ))
            ->add('firstname')
            ->add('lastname')
            //->add('username')
            ->add('email', 'email')
            ->add('plainpassword', 'password', array('label' => 'Password'))
            //->add('hiredate', 'date', array(
            //    'widget' => 'single_text',
            //    'required' => false
            //))
            //->add('datelastpromotion', 'date', array(
            //    'widget' => 'single_text',
            //    'required' => false
            //))
            //->add('photo')
            ->add('language')
            //->add('supervisor')
            //->add('policy')
            //->add('role')
            //->add('organization')
            //->add('employeefunction')
            //->add('roles', 'choice', array(
            //    'choices' => array(
            //    'ROLE_USER'   => 'Medewerker',
            //    'ROLE_ADMIN' => 'HR / Management',
            //    ), 'multiple' => true))        
             ;
    }

    /**
     *
     * @param OptionsResolverInterface $resolver            
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Person'
        ));
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_person';
    }
}
