<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateReservation', DateType::class, [
                'attr' => [
                   'class' => 'form-control'
                ],
                'label' => 'Date de réservation'
            ])
            ->add('hourReservation', TimeType::class, [
                'attr' => [
                   'class' => 'form-control'
                ],
                'label' => 'Heure de réservation'
            ])
            ->add('numberPeople', null, [
                'attr' => [
                   'class' => 'form-control'
                ],
                'label' => 'Nombre de personnes'
            ])
            ->add('allergy', null, [
                'attr' => [
                   'class' => 'form-control'
                ],
                'label' => 'Allergie(s)'
            ])
            ->add('restaurant', EntityType::class, [
                'class' => 'App\Entity\Restaurant',
                'choice_label' => 'name',
                'attr' => [
                   'class' => 'form-control'
                ],
                'label' => 'Restaurant'
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
