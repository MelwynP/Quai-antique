<?php

namespace App\Form;

use App\Entity\Capacity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotEqualTo;

class CapacityForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('capacityMaxLunch', IntegerType::class, [
        'label' => 'Nombre de convive maximum pour le déjeuner',
        'constraints' => [
          new GreaterThan([
            'value' => -1,
            'message' => 'Le nombre de convive ne peut pas être negatif.',
          ]),
          new NotEqualTo([
            'value' => 0,
            'message' => 'Le nombre de convive ne peut pas être égal à zéro.',
          ]),
          new LessThanOrEqual([
            'value' => 120,
            'message' => 'Le nombre de convive ne peut pas être supérieur à 120.',
          ]),
        ],
      ])
      ->add('capacityMaxDinner', IntegerType::class, [
        'label' => 'Nombre de convive maximum pour le déjeuner',
        'constraints' => [
          new GreaterThan([
            'value' => -1,
            'message' => 'Le nombre de convive ne peut pas être negatif.',
          ]),
          new NotEqualTo([
            'value' => 0,
            'message' => 'Le nombre de convive ne peut pas être égal à zéro.',
          ]),
          new LessThanOrEqual([
            'value' => 120,
            'message' => 'Le nombre de convive ne peut pas être supérieur à 120.',
          ]),
        ],
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Capacity::class,
    ]);
  }
}
