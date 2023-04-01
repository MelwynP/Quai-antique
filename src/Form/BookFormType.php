<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Validator\Constraints\IsTrue;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Récupération de la date actuelle
    $now = new \DateTime();

    // Calcul de la date maximale de réservation (un mois à l'avance)
    $maxDate = (clone $now)->add(new \DateInterval('P1M'));

    $builder
            ->add('dateReservation', DateTimeType::class, [
                'attr' => [
                'class' => 'form-control'
                ],
                'label' => 'Date et heure de réservation',
                'html5' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new GreaterThan([
                        'value' => $now,
                        'message' => 'La date de réservation doit être supérieure ou égale à aujourd\'hui'
                    ]),
                    new LessThanOrEqual([
                        'value' => $maxDate,
                        'message' => 'La date de réservation doit être inférieure ou égale à ' . $maxDate->format('Y-m-d')
                    ])
                ]
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
                'M.' => 'M.',
                'Mme.' => 'Mme.',
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
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
