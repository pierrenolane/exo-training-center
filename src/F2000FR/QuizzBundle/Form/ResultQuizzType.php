<?php

namespace F2000FR\QuizzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultQuizzType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('resultQuestions', FormType\CollectionType::class, array(
                    'entry_type' => ResultQuestionType::class,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\QuizzBundle\Entity\ResultQuizz',
        ));
    }

}
