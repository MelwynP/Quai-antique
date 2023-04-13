<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UpdateUserFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder

      ->add('name', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Nom'
      ])

      ->add('firstname', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Prénom'
      ])


      ->add('phone', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Téléphone'
      ])

      ->add('allergy', null, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Allergie(s)'
      ])

      ->add('numberPeople', null, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Nombre de convive(s)'
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
      'data_class' => User::class,
    ]);
  }
}
