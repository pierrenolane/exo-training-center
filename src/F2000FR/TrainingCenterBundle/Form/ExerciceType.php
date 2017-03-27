<?php

namespace F2000FR\TrainingCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use F2000FR\TrainingCenterBundle\Entity\Exercice;

class ExerciceType extends AbstractType {

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
                    'attr' => array('placeholder' => 'Intitulé de l\'exercice'),
                    'label' => false,
                    'required' => false,
                ))
                ->add('description', FormType\TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Objectif',
                        'rows' => 3,
                    ),
                    'label' => false,
                    'required' => false,
                ))
                ->add('howTo', FormType\TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Déroulement de l\'exercice',
                        'rows' => 10,
                    ),
                    'label' => false,
                    'required' => false,
                ))
                ->add('clue', FormType\TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Indices',
                        'rows' => 6,
                    ),
                    'label' => false,
                    'required' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\TrainingCenterBundle\Entity\Exercice',
        ));
    }

}
