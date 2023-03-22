<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use App\Entity\Flat;
use App\Entity\Menu;
use App\Entity\Booking;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

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


            $faker = Faker\Factory::create('fr_FR');

            for($bkg = 1; $bkg <= 10; $bkg++){
            $booking = new Booking();
            $booking->setDateReservation($faker->dateTimeBetween('-1 week', 'now'));
            $booking->setHourReservation($faker->dateTimeBetween('-1 week', '+1 week'));
            $booking->setNumberPeople($faker->randomNumber(1));
            $booking->setAllergy($faker->text(10));
            $booking->setRestaurant($restaurant);
            $manager->persist($booking);
            }

            for($mnu = 1; $mnu <= 10; $mnu++){            
            $menu = new Menu();
            $menu->setName($faker->text(10));
            $menu->setDescription($faker->text(30));
            $menu->setPrice($faker->randomNumber(3));
            $menu->setRestaurant($restaurant);
            $manager->persist($menu);
            }   

            for($pht=1; $pht <=10 ; $pht++){ 
            $photo = new Photo();
            $photo->setName($faker->text(10));
            $photo->setFile($faker->text(10));
            $photo->setImage($faker->imageUrl(640, 480, 'food', true));
            $manager->persist($photo);
            }
            
            for ($flt=1; $flt <=20 ; $flt++ ) { 
            $flat = new Flat();
            $flat->setName($faker->text(10));
            $flat->setDescription($faker->text(100));
            $flat->setPrice($faker->randomFloat(2, 10, 10));
            $flat->setIngredient($faker->text(50));
            $flat->setPhoto($photo);
            $flat->setRestaurant($restaurant);
            $manager->persist($flat);
            }


            $manager->flush();
        
    }
}
