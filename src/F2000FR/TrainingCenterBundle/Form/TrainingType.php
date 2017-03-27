<?php

namespace F2000FR\TrainingCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', FormType\TextType::class, array(
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Intitulé de la formation'
                    ],
                    'label' => false,
                ))
                ->add('client', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Client'),
                    'label' => false,
                ))
                ->add('sponsor', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Partenaire'),
                    'label' => false,
                    'required' => false,
                ))
                ->add('description', FormType\TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Description',
                        'rows' => 10,
                    ),
                    'label' => false,
                ))
                ->add('location', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Localisation'),
                    'label' => false,
                ))
                ->add('private', FormType\CheckboxType::class, array(
                    'attr' => [],
                    'label' => 'Privée ?',
                    'required' => false,
                ))
                ->add('startDate', FormType\DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'label' => false,
                    // do not render as type="date", to avoid HTML5 date pickers
                    'html5' => false,
                    // add a class that can be selected in JavaScript
                    'attr' => ['placeholder' => 'Date de début'],
                ))
                ->add('endDate', FormType\DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    // do not render as type="date", to avoid HTML5 date pickers
                    'label' => false,
                    'html5' => false,
                    // add a class that can be selected in JavaScript
                    'attr' => ['placeholder' => 'Date de fin'],
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\TrainingCenterBundle\Entity\Training',
        ));
    }

}
