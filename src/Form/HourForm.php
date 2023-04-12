<?php

namespace App\Form;

use App\Entity\Hour;
use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class HourForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('dayWeek', ChoiceType::class, [
        'choices' => [
          'Lundi' => 'Lundi',
          'Mardi' => 'Mardi',
          'Mercredi' => 'Mercredi',
          'Jeudi' => 'Jeudi',
          'Vendredi' => 'Vendredi',
          'Samedi' => 'Samedi',
          'Dimanche' => 'Dimanche',
        ],
        'attr' => [
          'class' => 'form-control',
        ],
        'label' => 'Jour de semaine'
      ])

      ->add(
        'lunchOpeningTime',
        TextType::class,
        [
          'attr' => [
            'class' => 'form-control'
          ],
          'label' => 'Heure d\'ouverture du déjeuner',
          'required' => false,
          'constraints' => [
            new Regex([
              'pattern' => '/^(fermé|Fermé|FERMÉ|vacances|Vacances|VACANCES|ferié|Ferié|FERIÉ)$|[0-9]{2}h[0-9]{2}$/',
              'message' => 'Veuillez saisir des heures valides (ex:"12h00") ou les mot "Fermé", "Vacances", "Ferié".'
            ])
          ]
        ]
      )

      ->add('lunchClosingTime', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Heure de fermeture du déjeuner',
        'required' => false,
        'constraints' => [
          new Regex([
            'pattern' =>
            '/^(fermé|Fermé|FERMÉ|vacances|Vacances|VACANCES|ferié|Ferié|FERIÉ)$|[0-9]{2}h[0-9]{2}$/',
            'message' => 'Veuillez saisir des heures valides (ex:"12h00") ou les mot "Fermé", "Vacances", "Ferié".'
          ])
        ]
      ])

      ->add('dinnerOpeningTime', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Heure d\'ouverture du dinner',
        'required' => false,
        'constraints' => [
          new Regex([
            'pattern' =>
            '/^(fermé|Fermé|FERMÉ|vacances|Vacances|VACANCES|ferié|Ferié|FERIÉ)$|[0-9]{2}h[0-9]{2}$/',
            'message' => 'Veuillez saisir des heures valides (ex:"12h00") ou les mot "Fermé", "Vacances", "Ferié".'
          ])
        ]
      ])

      ->add('dinnerClosingTime', TextType::class, [
        'attr' => [
          'class' => 'form-control'
        ],
        'label' => 'Heure de fermeture du dinner',
        'required' => false,
        'constraints' => [
          new Regex([
            'pattern' =>
            '/^(fermé|Fermé|FERMÉ|vacances|Vacances|VACANCES|ferié|Ferié|FERIÉ)$|[0-9]{2}h[0-9]{2}$/',
            'message' => 'Veuillez saisir des heures valides (ex:"12h00") ou les mot "Fermé", "Vacances", "Ferié".'
          ])
        ]
      ])

      ->add('restaurant', EntityType::class, [
        'class' => Restaurant::class,
        'choice_label' => 'name',
        'label' => 'Restaurant',
        'required' => false,
        'attr' => [
          'class' => 'form-control'
        ]
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Hour::class,
    ]);
  }
}
