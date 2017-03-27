<?php

namespace F2000FR\TrainingCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('login', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Identifiant ou adresse email'),
                    'label' => false
                ))
                ->add('password', FormType\PasswordType::class, array(
                    'attr' => array('placeholder' => 'Mot de passe'),
                    'label' => false
                ))
                ->add('Connexion', FormType\SubmitType::class, array(
                    'attr' => array('class' => 'btn btn-lg btn-primary btn-block'),
                    'label' => false
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\TrainingCenterBundle\Entity\User',
        ));
    }

}
