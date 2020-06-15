<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

class BookingType extends AbstractType {

    /**
     * @param FormBuilderInterface<string|FormBuilderInterface> $builder
     * @param array<mixed>                                      $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'transport',
                ChoiceType::class,
                [
                    'required'           => false,
                    'expanded'           => true,
                    'multiple'           => true,
                    'choices'            => [
                        'car' => 'Car',
                        'bus' => 'Bus',
                        'train' => 'Train',
                        'plane' => 'Plane'
                    ],
                    'attr' => ['class' => 'transport-option']
                ])
            ->add(
                'activities',
                ChoiceType::class,
                [
                    'required'           => false,
                    'expanded'           => true,
                    'multiple'           => true,
                    'choices'            => [
                        'brandenburger_tor' => 'Brandenburger Tor',
                        'holocaust_museum' => 'Holocaust Museum',
                        'bike_tour' => 'Bike Tour'
                    ],
                ])
            ->add(
            'housing',
                ChoiceType::class,
                [
                    'required'           => false,
                    'expanded'           => true,
                    'multiple'           => true,
                    'choices'            => [
                        'hotel' => 'Steigenberger Hotel Am Kanzleramt',
                        'camping' => 'Deutscher Camping-Club LV Berlin'
                    ],
                ])
            ->add(
                'startDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'attr' => ['class' => 'date-picker']
                ])
            ->add(
                'endDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'attr' => ['class' => 'date-picker']
                ])
            ->add('email', EmailType::class);
    }
}
