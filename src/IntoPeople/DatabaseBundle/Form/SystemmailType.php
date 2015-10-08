<?php

namespace IntoPeople\DatabaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SystemmailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['data']->getMailtype()->getName() == 'weekbeforedeadline'){
            $builder
                ->add('sender')
                ->add('subject')
                ->add('mailtype', new MailtypeType())
                ->add('body', 'textarea', array(
                'attr' => array('rows' => 10)));
        }else {
            $builder
                ->add('sender')
                ->add('subject')
                ->add('body', 'textarea', array(
                    'attr' => array('rows' => 10)));
        }

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntoPeople\DatabaseBundle\Entity\Systemmail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'intopeople_databasebundle_systemmail';
    }
}
