<?php
namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        ->add('language')
        ->add('photo', 'vich_image', array(
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
        ;

    }
 
    
    public function getParent()
    {
        return 'fos_user_profile';
    }


    public function getName()
    {
        return 'app_user_profile';
    }


}
