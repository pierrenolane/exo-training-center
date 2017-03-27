<?php

namespace F2000FR\TrainingCenterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAccountType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('email', FormType\EmailType::class, array(
                    'attr' => array('placeholder' => 'Adresse email'),
                    'label' => false,
                ))
                ->add('firstName', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Prénom'),
                    'label' => false,
                ))
                ->add('lastName', FormType\TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Nom',
                        'class' => 'form-uppercase'
                    ),
                    'label' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\TrainingCenterBundle\Entity\User',
        ));
    }

}
