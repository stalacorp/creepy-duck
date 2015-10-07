<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MidyearCommentType extends AbstractType
{
    private $locale;
    public function __construct($locale) {
        $this->locale = $locale;
    }

    /**
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
            ->add('commentSup', 'textarea')
            ->add('feedbackdate', 'date', array(
                'widget' => 'single_text',
                'required' => false,
                'format' => $format
            ))
        ;
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
