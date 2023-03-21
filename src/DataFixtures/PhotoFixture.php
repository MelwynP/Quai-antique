<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PhotoFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($pht = 1; $pht <= 10; $pht++){
            $photo = new Photo();
            $photo->setName($faker->name);
            $photo->setFile($faker->text(10));

            $manager->persist($photo);
        }

        $manager->flush();
    }
}
