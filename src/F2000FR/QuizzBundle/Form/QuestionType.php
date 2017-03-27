<?php

namespace F2000FR\QuizzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', FormType\TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Intitulé de la question',
                        'class' => 'quizz-question',
                    ),
                    'label' => false,
                    'required' => false,
                ))
                ->add('responses', FormType\CollectionType::class, array(
                    'attr' => array(
                        'class' => 'quizz-response-block',
                    ),
                    'entry_type' => ResponseType::class,
                    'label' => false,
                    'required' => false,
                    'allow_add' => true,
                    'delete_empty' => true,
                    'prototype' => true,
                    'prototype_name' => '__responseIdx__',
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\QuizzBundle\Entity\Question',
        ));
    }

}
