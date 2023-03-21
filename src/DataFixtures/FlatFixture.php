<?php

namespace App\DataFixtures;

use App\Entity\Flat;
use App\Entity\Photo;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class FlatFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($fl = 1; $fl <= 10; $fl++){
            $flat = new Flat();
            $flat->setName($faker->name);
            $flat->setPrice($faker->randomNumber(2));
            $flat->setDescription($faker->text(10));
            $flat->setIngredient($faker->text(10));
            $flat->setPhoto($faker->text(10));
            $flat->setRestaurant($faker->text(10));

            $manager->persist($flat);

        $manager->flush();
        }
    }
}
