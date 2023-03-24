<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use App\Entity\Flat;
use App\Entity\Booking;
use App\Entity\Category;
use App\Entity\Hour;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Query\AST\BetweenExpression;
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
        $restaurant->setCity('Chambéry');
        $restaurant->setZipCode('73000');
        $manager->persist($restaurant);

        $category = new Category();
        $category->setName('Entrée');
        $category->setDescription('C\'est le premier service dans un repas ');
        $manager->persist($category);
        $category = new Category();
        $category->setName('Burger');
        $category->setDescription('Un burger est un sandwich composé de deux pains de forme ronde, généralement garnis d\'un steak haché et de crudités ainsi que de sauce.');
        $manager->persist($category);
        $category = new Category();
        $category->setName('Plat');
        $category->setDescription('Un plat peut être pris seul ou avec d\'autre categories.');
        $manager->persist($category);

        $faker = Faker\Factory::create('fr_FR');

        for($bkg = 1; $bkg <= 10; $bkg++){
        $booking = new Booking();
        $booking->setDateReservation($faker->dateTimeBetween('-1 week', 'now'));
        $booking->setHourReservation($faker->dateTimeBetween('-1 week', '+1 week'));
        $booking->setNumberPeople($faker->randomNumber(1));
        $booking->setAllergy($faker->text(10));
        $manager->persist($booking);
        }

        for($pht=1; $pht <=10 ; $pht++){ 
        $photo = new Photo();
        $photo->setName($faker->text(10));
        $photo->setFile($faker->text(10));
        $photo->setImage($faker->imageUrl(640, 480, 'food', true));
        $manager->persist($photo);
        }

        for ($flt=1; $flt <=10 ; $flt++ ) { 
        $flat = new Flat();
        $flat->setName($faker->text(10));
        $flat->setDescription($faker->text(100));
        $flat->setPrice($faker->randomFloat(2, 10, 10));
        $flat->setPhoto($photo);
        $flat->setRestaurant($restaurant);
        $flat->setCategory($category);
        $manager->persist($flat);
        }
    
        for($hr = 1; $hr <= 7; $hr++){
        $hour = new Hour();
        $hour->setDayWeek($faker->dateTimeBetween('-1 week', 'now'));
        $hour->setOpeningTime($faker->dateTimeBetween('-1 week', 'now'));
        $hour->setRestaurant($restaurant);
        $manager->persist($hour);
        }

        $manager->flush();
    }
}