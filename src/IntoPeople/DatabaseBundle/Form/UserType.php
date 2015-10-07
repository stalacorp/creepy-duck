<?php
namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class UserType extends AbstractType
{


    private $locale;
    public function __construct($locale) {
        $this->locale = $locale;
    }

    
    /**
     *
     * @param FormBuilderInterface $builder            
     * @param array $options            
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $format = "MM/dd/yyyy";

        if ($this->locale == 'nl'){
            $format = 'dd-MM-yyyy';
        }


        $builder
            ->add('photo', 'vich_image', array(
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
            ->add('firstname')
            ->add('lastname')
            //->add('username')
            ->add('email', 'email')
            ->add('hiredate', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'format' => $format,
            ))
            ->add('datelastpromotion', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'format' => $format,
            ))
            ->add('team', 'text', array('required' => false))
            ->add('language', 'entity',array(
                'class' => 'IntoPeopleDatabaseBundle:Language'))
            ->add('supervisor')
            ->add('jobtitle', 'text' , array('mapped' => false,
                'attr'   =>  array(
                    'class'   => 'typeahead'),
                'required' => false,
            ))
            ->add('enabled', 'checkbox', array('required' => false))
            ->add('roles', 'choice', array(
                'choices' => array(
                    'ROLE_HR' => 'HR / Management',
                    'ROLE_SUPERVISOR' => 'Supervisor',
                ), 'multiple' => true,
                    'required' => false))
             ;

            
            
    }

    /**
     *
     * @param OptionsResolverInterface $resolver            
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\User'
        ));
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_user';
    }
}
