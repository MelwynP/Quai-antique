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
    private UserPasswordHasherInterface $passwordEncoder
  ) {
  }

  public function load(ObjectManager $manager): void
  {
    $admin = new User();
    $admin->setEmail('contact@quai-antique.tech');
    $admin->setName('Admin');
    // $admin->setFirstname('Admin');
    $admin->setPassword($this->passwordEncoder->hashPassword($admin, 'azerty'));
    $admin->setRoles(['ROLE_ADMIN']);
    // $admin->setPhone('');
    // $admin->setAllergy('');
    $admin->setCivility('Monsieur');
    $admin->setNumberPeople('0');
    $admin->setIsVerified(1);
    $manager->persist($admin);

    $faker = Faker\Factory::create('fr_FR');

    for ($usr = 1; $usr <= 10; $usr++) {
      $allergies = [' - ', 'allergie aux oeufs', 'allergie au lactose', 'allergie aux arachides', 'allergie au gluten', 'allergie aux fruits de mer'];
      $user = new User();
      $user->setEmail($faker->email);
      $user->setName($faker->lastName);
      $user->setFirstname($faker->firstName);
      $user->setPassword($this->passwordEncoder->hashPassword($user, 'user'));
      $user->setPhone($faker->phoneNumber);
      $user->setAllergy($faker->randomElement($allergies));
      $user->setCivility($faker->randomElement(['Monsieur', 'Madame']));
      $user->setNumberPeople($faker->numberBetween(2, 8));
      $manager->persist($user);
    }

    $manager->flush();
  }
}
