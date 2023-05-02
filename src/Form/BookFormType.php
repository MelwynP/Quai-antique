<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Test\FormInterface as TestFormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('dateReservation', DateType::class, [
                'label' => 'Date de réservation *',
                'placeholder' => 'Sélectionnez une date',
                'widget' => 'single_text',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'required' => 'required',

                ]

            ])

            ->add('serviceType', ChoiceType::class, [
                'label' => 'Service',
                'placeholder' => 'Sélectionnez un service',
                'required' => true,

                'attr' => [
                    'class' => 'form-control',
                    'required' => 'required',
                ],
                'choices' => [
                    'Déjeuner' => 'lunch',
                    'Dîner' => 'dinner',
                ],
            ])

            ->add('hour', ChoiceType::class, [
                'label' => 'Heure',
                'placeholder' => 'Sélectionnez une heure',
                'required' => true,

            ])

            // ->add('hour', ChoiceType::class, [
            //     'label' => 'Heure',
            //     'placeholder' => 'Sélectionnez une heure',
            //     'choices' => [
            //         '12:00' => '12:00',
            //         '12:15' => '12:15',
            //         '12:30' => '12:30',
            //         '12:45' => '12:45',
            //         '13:00' => '13:00',
            //         '19:00' => '19:00',
            //         '19:15' => '19:15',
            //         '19:30' => '19:30',
            //         '19:45' => '19:45',
            //         '20:00' => '20:00',
            //     ],
            // ])


            // ->add('hour', ChoiceType::class, [
            //     'label' => 'Heure',
            //     'placeholder' => 'Sélectionnez une heure',
            //     'choices' => $this->getTimeSlotsWithLabels(),
            //     'group_by' => function ($value, $key, $index) {
            //         if (strpos($value, 'Déjeuner') !== false) {
            //             return 'Déjeuner';
            //         }
            //         return 'Dîner';
            //     }
            // ])

            // ->add('numberPeople', IntegerType::class, [
            //     'label' => 'Nombre de convives',
            //     'constraints' => [
            //         new GreaterThan([
            //             'value' => -1,
            //             'message' => 'Le nombre de convive ne peut pas être negatif.',
            //         ]),
            //         new NotEqualTo([
            //             'value' => 0,
            //             'message' => 'Le nombre de convive ne peut pas être égal à zéro.',
            //         ]),
            //         new LessThanOrEqual([
            //             'value' => 8,
            //             'message' => 'Au delà de 8 convives, merci de nous appeler.',
            //         ]),
            //     ],
            // ])

            ->add('numberPeople', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'required' => 'required',
                ],
                'label' => 'Nombre de convive(s) *',
                'required' => true,

                'placeholder' => 'Sélectionnez un nombre de convive(s)',
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

            ->add('allergy', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Allergie(s)',
                'required' => false, // rend le champ obligatoire

            ])

            ->add('civility', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Civilité *',
                'required' => true,
                'placeholder' => 'Veuillez renseigner votre civilité',
                'choices' => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame'
                ]
            ])

            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false, // rend le champ obligatoire
                'label' => 'Prénom'
            ])

            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom *',
                'required' => true

            ])

            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false, // rend le champ obligatoire
                'label' => 'Téléphone'
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'exemple@domaine.com'

                ],
                'required' => true, // rend le champ obligatoire
                'label' => 'E-mail *'
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



    // private function getTimeSlotsWithLabels()
    // {
    //     $timeSlots = [];
    //     $lunchStart = new \DateTime('12:00');
    //     $dinnerStart = new \DateTime('19:00');
    //     $interval = new \DateInterval('PT15M'); // 15 minutes interval
    //     $lunchEnd = (clone $lunchStart)->add(new \DateInterval('PT1H15M'));
    //     $dinnerEnd = (clone $dinnerStart)->add(new \DateInterval('PT1H15M'));
    //     while ($lunchStart < $lunchEnd) {
    //         $timeSlots[$lunchStart->format('H:i')] = 'Déjeuner - ' . $lunchStart->format('H:i');
    //         $lunchStart->add($interval);
    //     }
    //     while ($dinnerStart < $dinnerEnd) {
    //         $timeSlots[$dinnerStart->format('H:i')] = 'Dîner - ' . $dinnerStart->format('H:i');
    //         $dinnerStart->add($interval);
    //     }
    //     return $timeSlots;
    // }
}
