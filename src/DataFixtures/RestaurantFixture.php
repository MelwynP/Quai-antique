<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RestaurantFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $restaurant = new Restaurant();
        $restaurant->setName('Quai-Antique');
        $restaurant->setAddress('1 rue du port');
        $restaurant->setPhone('06000000000');
        $restaurant->setEmail('contact@quai-antique.com');
        $restaurant->setAveragePrice('70');
        $restaurant->setMaximumCapacity('80');
        $restaurant->setAvailabilityCapacity('40');
        $restaurant->setNumberTable('30');
        $restaurant->setNumberChair('80');
        $manager->persist($restaurant);

        $manager->flush();
    }
}
