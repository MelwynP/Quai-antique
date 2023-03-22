<?php

namespace App\DataFixtures;

use App\Repository\RestaurantRepository;
use App\Entity\Hour;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class HourFixture extends Fixture implements DependentFixtureInterface
{

    public function __construct(
        private RestaurantRepository $restaurantRepository
    ){}

    public function load(ObjectManager $manager): void
    {
      $faker = Faker\Factory::create('fr_FR');

        for($hr = 1; $hr <= 7; $hr++){
            $hour = new Hour();
            $hour->setDayWeek($faker->dateTimeBetween('-1 week', 'now'));
            $hour->setOpeningTime($faker->dateTimeBetween('-1 week', 'now'));

            $manager->persist($hour);
        }

        $restaurant = $this->restaurantRepository->findAll();
            foreach ($restaurant as $restaurant) {
                $hour->addRestaurant($restaurant);
            }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            RestaurantFixture::class,
        ];
    }
}

