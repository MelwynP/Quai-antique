<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder

      ->add('name', TextType::class, [
        'attr' => [
          'placeholder' => 'Modifiez votre nom ici',
          'class' => 'form-control',
        ],
        'label' => 'Nom *',
        'required' => true
      ])

      ->add('firstname', TextType::class, [
        'attr' => [
          'placeholder' => 'Modifiez votre prénom ici',
          'class' => 'form-control',
        ],
        'label' => 'Prénom',
        'required' => false,

      ])


      ->add('phone', TextType::class, [
        'attr' => [
          'class' => 'form-control',
          'placeholder' => '06 00 00 00 00',
        ],
        'label' => 'Téléphone',
        'required' => false,
      ])


      ->add('allergy', null, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Allergie(s)',
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
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
