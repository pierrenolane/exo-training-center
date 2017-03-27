<?php

namespace F2000FR\QuizzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', FormType\TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Intitulé de la réponse',
                        'class' => 'quizz-response',
                    ),
                    'label' => false,
                    'required' => false,
                ))
                ->add('valid', FormType\CheckboxType::class, array(
                    'label' => false,
                    'required' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\QuizzBundle\Entity\Response',
        ));
    }

}
