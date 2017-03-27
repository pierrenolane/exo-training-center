<?php

namespace F2000FR\TrainingCenterBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use F2000FR\TrainingCenterBundle\Entity\User;
use F2000FR\TrainingCenterBundle\Form\Type\UserAccountType;

class AbstractAdminUserType extends UserAccountType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder
                ->add('role', FormType\ChoiceType::class, array(
                    'choices' => array(
                        'Stagiaire' => User::ROLE_STUDENT,
                        'Superviseur' => User::ROLE_MANAGER,
                        'Administrateur' => User::ROLE_ADMIN,
                    ),
                    'label' => false,
                ))
                ->add('login', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Identifiant'),
                    'label' => false,
                ))
                ->add('comment', FormType\TextareaType::class, array(
                    'attr' => array('placeholder' => 'Commentaire'),
                    'label' => false,
                    'required' => false,
                ))
                ->add('status', FormType\ChoiceType::class, array(
                    'choices' => array(
                        'Actif' => User::STATUS_ACTIVE,
                        'Démissionnaire' => User::STATUS_RESIGNING,
                        'Inactif' => User::STATUS_INACTIVE,
                        'Désactivé' => User::STATUS_DISABLED,
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
