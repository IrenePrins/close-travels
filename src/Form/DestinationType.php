<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DestinationType extends AbstractType {

    /**
     * @param FormBuilderInterface<string|FormBuilderInterface> $builder
     * @param array<mixed>                                      $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title');
    }

}
