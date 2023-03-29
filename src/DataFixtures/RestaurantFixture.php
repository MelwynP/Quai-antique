<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use App\Entity\Flat;
use App\Entity\Booking;
use App\Entity\Hour;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class RestaurantFixture extends Fixture implements DependentFixtureInterface
{
    private $counter = 1;

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


        $faker = Faker\Factory::create('fr_FR');
        
        for($bkg = 1; $bkg <= 10; $bkg++){
        $booking = new Booking();
        $booking->setDateReservation($faker->dateTimeBetween('-1 week', 'now'));
        $booking->setHourReservation($faker->dateTimeBetween('-1 week', 'now'));
        $booking->setNumberPeople($faker->numberBetween(2, 10));
        $booking->setAllergy($faker->text(10));
        $manager->persist($booking);
        }
        
        for($pht=1; $pht <=20 ; $pht++){ 
        $photo = new Photo();
        $photo->setName($faker->text(10));
        $photo->setFile($faker->text(10));
        $photo->setImage($faker->imageUrl(640, 480, 'food', true));
        $manager->persist($photo);
        $this->addReference('pht-' . $this->counter, $photo);
        $this->counter++;
        }
        
        for ($flt=1; $flt <=20 ; $flt++ ) { 
        $flat = new Flat();
        $flat->setName($faker->text(10));
        $flat->setDescription($faker->text(100));
        $flat->setPrice($faker->numberBetween(6, 25));
        //On va chercher une ref de menu aléatoire
        $menu = $this->getReference('mnu-' . rand(1, 3));
        $flat->setMenu($menu);
        //On va chercher une ref de catégorie aléatoire
        $category = $this->getReference('cat-' . rand(1, 5));
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
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
    
    public function getDependencies()
    {
        return [
            CategoryFixture::class,
            MenuFixture::class,
        ];
    }
}