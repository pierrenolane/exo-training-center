<?php

namespace F2000FR\QuizzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizzType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('reference', FormType\TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Référence',
                        'class' => 'form-uppercase'
                    ),
                    'label' => false,
                    'required' => false,
                ))
                ->add('name', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Intitulé du quizz'),
                    'label' => false,
                    'required' => false,
                ))
                ->add('questions', FormType\CollectionType::class, array(
                    'attr' => array(
                        'class' => 'quizz-question-block',
                    ),
                    'entry_type' => QuestionType::class,
                    'required' => false,
                    'allow_add' => true,
                    'delete_empty' => true,
                    'prototype' => true,
                    'prototype_name' => '__questionIdx__',
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\QuizzBundle\Entity\Quizz',
        ));
    }

}
