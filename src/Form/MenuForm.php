<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Nom du menu'
      ])

      ->add('description', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Description du menu',
        'required' => false
      ])

      ->add('price', MoneyType::class, [
        'label' => 'Prix',
        'constraints' => [
          new Positive(
            message: 'Le prix ne peut être négatif'
          )
        ]
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Menu::class,
    ]);
  }
}
