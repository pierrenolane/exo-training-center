<?php

namespace F2000FR\TrainingCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use F2000FR\TrainingCenterBundle\Entity\Module;

class ModuleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('reference', FormType\TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Référence',
                        'class' => 'form-uppercase'
                    ),
                    'label' => false,
                ))
                ->add('category', EntityType::class, array(
                    'class' => 'F2000FRTrainingCenterBundle:Category',
                    'choice_label' => 'name',
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                        return $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
                    },
                    'group_by' => function ($category) {
                        if ($category->getParent() instanceof \F2000FR\TrainingCenterBundle\Entity\Category) {
                            return $category->getParent()->getName();
                        }
                        return 'Racine';
                    },
                    'label' => false,
                ))
                ->add('name', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Intitulé du module'),
                    'label' => false,
                ))
                ->add('description', FormType\TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Description',
                        'rows' => 4,
                    ),
                    'label' => false,
                    'required' => false,
                ))
                ->add('keypoints', FormType\TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Points-clés',
                        'rows' => 6,
                    ),
                    'label' => false,
                    'required' => false,
                ))
                ->add('ressources', FormType\TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Ressources',
                        'rows' => 6,
                    ),
                    'label' => false,
                    'required' => false,
                ))
                ->add('privateContent', FormType\TextareaType::class, array(
                    'attr' => array(
                        'placeholder' => 'Contenu privé',
                        'rows' => 4,
                    ),
                    'label' => false,
                    'required' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\TrainingCenterBundle\Entity\Module',
        ));
    }

}
