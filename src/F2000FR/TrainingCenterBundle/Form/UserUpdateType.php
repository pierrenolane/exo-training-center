<?php

namespace F2000FR\TrainingCenterBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class UserUpdateType extends AbstractAdminUserType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
    }

}
