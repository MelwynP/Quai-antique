<?php

namespace App\DataFixtures;

use App\Entity\Hour;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class HourFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $faker = Faker\Factory::create('fr_FR');

        for($hr = 1; $hr <= 7; $hr++){
            $hour = new Hour();
            $hour->setDayWeek($faker->dateTimeBetween('-1 week', 'now'));
            $hour->setOpeningTime($faker->dateTimeBetween('-1 week', 'now'));

            $manager->persist($hour);
        }

        $manager->flush();
    }
}

