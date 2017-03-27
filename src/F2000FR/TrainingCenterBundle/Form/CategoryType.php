<?php

namespace F2000FR\TrainingCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('parent', EntityType::class, array(
                    'class' => 'F2000FRTrainingCenterBundle:Category',
                    'choice_label' => 'name',
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                        return $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
                    },
                    'placeholder' => 'Catégorie parente',
                    'group_by' => function ($category) {
                        if ($category->getParent() instanceof \F2000FR\TrainingCenterBundle\Entity\Category) {
                            return $category->getParent()->getName();
                        }
                        return 'Racine';
                    },
                    'label' => false,
                    'required' => false,
                ))
                ->add('name', FormType\TextType::class, array(
                    'attr' => array('placeholder' => 'Intitulé de la catégorie'),
                    'label' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'F2000FR\TrainingCenterBundle\Entity\Category',
        ));
    }

}
