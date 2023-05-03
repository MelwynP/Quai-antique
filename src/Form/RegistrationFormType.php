<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

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

            ->add('allergy', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Allergie(s)'
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'exemple@domaine.com'
                ],
                'required' => true,
                'label' => 'E-mail *'
            ])

            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control',
                    'placeholder' => '********',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'mot de pass obligatoire',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit comporter au minimum {{ limit }} caractères',
                        'max' => 200,
                        'maxMessage' => 'Le mot de passe doit comporter au maximum {{ limit }} caractères',
                    ]),
                ],
                'label' => 'Mot de passe *',
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
            'data_class' => User::class,
        ]);
    }
}
