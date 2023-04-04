<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,  [
            // On y ajoute des options avec le tableau
                'label' => 'Entrez votre e-mail',
            // On peut ajouter un placeholder et d'autre attribut on utilise
                'attr' => [
                    'placeholder' => 'ecrivezvotre@mail.com',
                    ]
            // On peut aussi ajouter des contraintes
            ])
            // On ne place pas le bouton ici mais dans la vue
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
