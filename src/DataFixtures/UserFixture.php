<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class UserFixture extends Fixture
{
    //pour haché les mdp on a besoin d'un constructeur
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder){}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setName('admin');
        $admin->setFirstname('admin');
        $admin->setPassword($this->passwordEncoder->hashPassword($admin, 'azerty'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPhone('0606060606');
        $admin->setAllergy('aucune');
        $admin->setCivility('Monsieur');
        $admin->setNumberPeople('0');
        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for($usr = 1; $usr <= 10; $usr++){
        $user = new User();
        $user->setEmail($faker->email);
        $user->setName($faker->lastName);
        $user->setFirstname($faker->firstName);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'user'));
        $user->setPhone($faker->phoneNumber);
        $user->setAllergy($faker->text(15));
        $user->setCivility($faker->randomElement(['Monsieur', 'Madame']));
        $user->setNumberPeople($faker->numberBetween(2, 10));
        $manager->persist($user);
        }

        $manager->flush();
    }
}
