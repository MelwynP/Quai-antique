<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {



        $builder
            ->add('dateReservation', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
            ])

            ->add('hourDejeuner', ChoiceType::class, [
                'choices' => [
                    'Déjeuner' => [

                        '----' => '----',
                        '12:00' => '12:00',
                        '12:15' => '12:15',
                        '12:30' => '12:30',
                        '12:45' => '12:45',
                        '13:00' => '13:00',
                    ],
                ],
                'attr' => [
                    'id' => 'hourDejeuner',
                    'class' => 'form-control',
                ],

                'label' => 'Choisissez votre heure de dejeuner',


            ])

            ->add('hourDinner', ChoiceType::class, [
                'choices' => [
                    'Dîner' => [

                        '----' => '----',
                        '19:00' => '19:00',
                        '19:15' => '19:15',
                        '19:30' => '19:30',
                        '19:45' => '19:45',
                        '20:00' => '20:00',
                    ],
                ],
                'attr' => [
                    'id' => 'hourDinner',
                    'class' => 'form-control',
                ],

                'label' => 'Choisissez votre heure de dîner',

            ])

            ->add('numberPeople', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nombre de convive(s)'
            ])

            ->add('allergy', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Allergie(s)'
            ])

            ->add('civility', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Civilité',
                'choices' => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame',
                ]
            ])

            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom'
            ])

            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom'
            ])

            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Téléphone'
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail'
            ])

            ->add('RGPDConsent', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => 'J\'accepte que mes données personnelles soient utilisées pour la gestion de ma réservation et de ma relation commerciale avec l\'établissement.'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
