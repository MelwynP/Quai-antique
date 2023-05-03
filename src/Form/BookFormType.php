<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                'required' => true,
                'html5' => false,
                'format' => 'd-M-y',
            ])

            ->add('serviceType', ChoiceType::class, [
                'label' => 'Sélectionnez un service *',
                'placeholder' => 'Choix du repas',
                'required' => true,

                'attr' => [
                    'class' => 'form-control',
                ],
                'choices' => [
                    'Déjeuner' => 'Déjeuner',
                    'Dîner' => 'Dîner',
                ],
            ])


            ->add('hour', ChoiceType::class, [
                'label' => 'Sélectionnez une heure *',
                'required' => true,
                'placeholder' => 'Choix de l\'horaire',
                'choices' => [
                    '12:00' => '12:00',
                    '12:15' => '12:15',
                    '12:30' => '12:30',
                    '12:45' => '12:45',
                    '13:00' => '13:00',
                    '19:00' => '19:00',
                    '19:15' => '19:15',
                    '19:30' => '19:30',
                    '19:45' => '19:45',
                    '20:00' => '20:00',
                    '20:15' => '20:15',
                    '20:30' => '20:30',
                    '20:45' => '20:45',
                    '21:00' => '21:00',
                ],
            ])



            ->add('numberPeople', ChoiceType::class, [
                'required' => true,
                'label' => 'Nombre de personnes *',
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ]
            ])


            ->add('civility', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame'
                ]
            ])

            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ecrivez votre prénom ici',
                    'class' => 'form-control',
                ],
                'label' => 'Prénom',
                'required' => false,

            ])

            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ecrivez votre nom ici',
                    'class' => 'form-control',
                ],
                'label' => 'Nom *',
                'required' => true
            ])

            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '06 00 00 00 00',
                ],
                'label' => 'Téléphone',
                'required' => false,
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'exemple@domaine.com'
                ],
                'required' => true,
                'label' => 'E-mail *'
            ])

            ->add('allergy', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Allergie(s)',

            ])

            ->add('RGPDConsent', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions d\'utilisation.',
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
