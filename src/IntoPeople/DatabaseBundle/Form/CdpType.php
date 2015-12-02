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
        $entity = $options['data'];
        $corequality1 = '';
        if ($entity->getCoreQuality1() != null){
            $corequality1 = $entity->getCoreQuality1()->getCoreQuality();
        }
        $corequality2 = '';
        if ($entity->getCoreQuality2() != null){
            $corequality2 = $entity->getCoreQuality2()->getCoreQuality();
        }
        $corequality3 = '';
        if ($entity->getCoreQuality3() != null){
            $corequality3 = $entity->getCoreQuality3()->getCoreQuality();
        }
        $corequality4 = '';
        if ($entity->getCoreQuality4() != null){
            $corequality4 = $entity->getCoreQuality4()->getCoreQuality();
        }
        $corequality5 = '';
        if ($entity->getCoreQuality5() != null){
            $corequality5 = $entity->getCoreQuality5()->getCoreQuality();
        }

        $challenge1 = '';
        if ($entity->getChallenge1() != null){
            $challenge1 = $entity->getChallenge1()->getChallenge();
        }
        $challenge2 = '';
        if ($entity->getChallenge2() != null){
            $challenge2 = $entity->getChallenge2()->getChallenge();
        }
        $challenge3 = '';
        if ($entity->getChallenge3() != null){
            $challenge3 = $entity->getChallenge3()->getChallenge();
        }
        $challenge4 = '';
        if ($entity->getChallenge4() != null){
            $challenge4 = $entity->getChallenge4()->getChallenge();
        }
        $challenge5 = '';
        if ($entity->getChallenge5() != null){
            $challenge5 = $entity->getChallenge5()->getChallenge();
        }

        $pitfall1 = '';
        if ($entity->getPitfall1() != null){
            $pitfall1 = $entity->getPitfall1()->getPitfall();
        }
        $pitfall2 = '';
        if ($entity->getPitfall2() != null){
            $pitfall2 = $entity->getPitfall2()->getPitfall();
        }
        $pitfall3 = '';
        if ($entity->getPitfall3() != null){
            $pitfall3 = $entity->getPitfall3()->getPitfall();
        }
        $pitfall4 = '';
        if ($entity->getPitfall4() != null){
            $pitfall4 = $entity->getPitfall4()->getPitfall();
        }
        $pitfall5 = '';
        if ($entity->getPitfall5() != null){
            $pitfall5 = $entity->getPitfall5()->getPitfall();
        }

        $builder
            ->add('coreQuality1', 'hidden', array('mapped' => false, 'data' => $corequality1))
            ->add('coreQuality2', 'hidden', array('mapped' => false, 'data' => $corequality2))
            ->add('coreQuality3', 'hidden', array('mapped' => false, 'data' => $corequality3))
            ->add('coreQuality4', 'hidden', array('mapped' => false, 'data' => $corequality4))
            ->add('coreQuality5', 'hidden', array('mapped' => false, 'data' => $corequality5))
            ->add('coreQuality1Why')
            ->add('coreQuality2Why')
            ->add('coreQuality3Why')
            ->add('coreQuality4Why')
            ->add('coreQuality5Why')
            ->add('challenge1', 'hidden', array('mapped' => false, 'data' => $challenge1))
            ->add('challenge2', 'hidden', array('mapped' => false, 'data' => $challenge2))
            ->add('challenge3', 'hidden', array('mapped' => false, 'data' => $challenge3))
            ->add('challenge4', 'hidden', array('mapped' => false, 'data' => $challenge4))
            ->add('challenge5', 'hidden', array('mapped' => false, 'data' => $challenge5))
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
            ->add('pitfall1', 'hidden', array('mapped' => false, 'data' => $pitfall1))
            ->add('pitfall2', 'hidden', array('mapped' => false, 'data' => $pitfall2))
            ->add('pitfall3', 'hidden', array('mapped' => false, 'data' => $pitfall3))
            ->add('pitfall4', 'hidden', array('mapped' => false, 'data' => $pitfall4))
            ->add('pitfall5', 'hidden', array('mapped' => false, 'data' => $pitfall5))
            ->add('pitfallWhy1')
            ->add('pitfallWhy2')
            ->add('pitfallWhy3')
            ->add('pitfallWhy4')
            ->add('pitfallWhy5')
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
