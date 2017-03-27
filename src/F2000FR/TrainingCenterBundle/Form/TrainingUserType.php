<?php

namespace F2000FR\TrainingCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingUserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('users', EntityType::class, array(
                    'attr' => array('size' => 15),
                    'class' => 'F2000FRTrainingCenterBundle:User',
                    'choices' => $builder->getData()->getUsers(),
                    'choice_label' => 'name',
                    'label' => false,
                    'multiple' => true,
                    'required' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\TrainingCenterBundle\Entity\Training',
        ));
    }

}
