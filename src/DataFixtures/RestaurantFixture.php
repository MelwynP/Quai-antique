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
use phpDocumentor\Reflection\Types\Null_;

class RestaurantFixture extends Fixture implements DependentFixtureInterface
{
    private $counter = 1;

    public function load(ObjectManager $manager): void
    {

        $restaurant = new Restaurant();
        $restaurant->setName('Quai-Antique');
        $restaurant->setAddress('2 rue Favre');
        $restaurant->setPhone('0388888888');
        $restaurant->setEmail('contact@quai-antique.com');
        $restaurant->setAveragePrice(40.50);
        $restaurant->setMaximumCapacity(60);
        $restaurant->setAvailabilityCapacity(40);
        $restaurant->setNumberTable(30);
        $restaurant->setNumberChair(80);
        $restaurant->setCity('Chambéry');
        $restaurant->setZipCode(73000);
        $manager->persist($restaurant);


        $faker = Faker\Factory::create('fr_FR');
        
        for($bkg = 1; $bkg <= 10; $bkg++){
        $booking = new Booking();
        $booking->setDateReservation($faker->dateTimeBetween('now', '+1 week'));
        $booking->setFirstname($faker->firstName);
        $booking->setname($faker->name);
        $booking->setEmail($faker->email);
        $booking->setPhone($faker->phoneNumber);
        $booking->setCivility($faker->randomElement(['Monsieur', 'Madame']));
        $booking->setNumberPeople($faker->numberBetween(2, 10));
        $booking->setAllergy($faker->text(20));
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

        //Entrées
        $flat = new Flat();
        $flat->setName('Salade gourmet');
        $flat->setDescription('roquette, endives, tommates cerises, noix de cajou grillées, pignon de pin, fromage de chèvre, vinaigrette au miel');
        $flat->setPrice(12.50);
        $category = $this->getReference('entrees');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Salade printanière');
        $flat->setDescription('mesclun, radis, asperges, comcombre, oeufs de caille, saumon fumé, feta, vinaigrette a l’huile d’olive');
        $flat->setPrice(12.50);
        $category = $this->getReference('entrees');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Soupe de crozets');
        $flat->setDescription('soupe traditionnelle avec crozets, lardons et fromage');
        $flat->setPrice(8.95);
        $menu = $this->getReference('savoyard');
        $flat->setMenu($menu);
        $category = $this->getReference('entrees');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Péla de pomme de terre');
        $flat->setDescription('pommes de terre, fromage à raclette, lardons');
        $flat->setPrice(8.50);
        $category = $this->getReference('entrees');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Diots');
        $flat->setDescription('saucisses de porc, vin blanc, oignons');
        $flat->setPrice(8.50);
        $menu = $this->getReference('savoyard');
        $flat->setMenu($menu);
        $category = $this->getReference('entrees');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);
        
        $flat = new Flat();
        $flat->setName('Croûte aux morilles');
        $flat->setDescription('pâte a tarte, morilles fraîches, oignons, fromage râpé');
        $flat->setPrice(9.50);
        $category = $this->getReference('entrees');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        //Burgers
        $flat = new Flat();
        $flat->setName('Burger végétarien');
        $flat->setDescription('steak végétal, laitue, tomate, oignon rouge, avocat, cheddar végétalien, sauce aux champignons ou sauce aux tomates');
        $flat->setPrice(16.50);
        $category = $this->getReference('burgers');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);
        
        $flat = new Flat();
        $flat->setName('Burger');
        $flat->setDescription('steak de boeuf, laitue, tomate, oignon rouge, cheddar, sauce barbecue');
        $flat->setPrice(16.00);
        $category = $this->getReference('burgers');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        //Plats
        $flat = new Flat();
        $flat->setName('Tartiflette');
        $flat->setDescription('pommes de terre, lardons, oignons et fromage à raclette');
        $flat->setPrice(15.50);
        $category = $this->getReference('plats');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Fondue savoyarde');
        $flat->setDescription('fromage fondue, pain, pommes de terre, charcuteries');
        $flat->setPrice(16.50);
        $menu = $this->getReference('savoyard');
        $flat->setMenu($menu);
        $category = $this->getReference('plats');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Fondue au gorgonzola');
        $flat->setDescription('fromage fondue gorgonzola, pain, pommes de terre, charcuteries');
        $flat->setPrice(16.50);
        $category = $this->getReference('plats');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Raclette');
        $flat->setDescription('fromage à raclette, pommes de terre, charcuterie et légumes');
        $flat->setPrice(16.95);
        $category = $this->getReference('plats');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Croziflette');
        $flat->setDescription('crozets, lardons, oignons et reblochon');
        $flat->setPrice(14.50);
        $menu = $this->getReference('savoyard');
        $flat->setMenu($menu);
        $category = $this->getReference('plats');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Entrecôte 240 à 260 gr');
        $flat->setDescription('sauce et accompagnement au choix');
        $flat->setPrice(16.50);
        $category = $this->getReference('plats');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Filet de poisson grillé aux herbes');
        $flat->setDescription('selon les saisons');
        $flat->setPrice(16.50);
        $category = $this->getReference('plats');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        //Fromages
        $flat = new Flat();
        $flat->setName('Fromage blanc au miel');
        $flat->setDescription('miel de Chambery');
        $flat->setPrice(4.50);
        $category = $this->getReference('fromages');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Fromage blanc aux framboises');
        $flat->setDescription('framboises fraîches');
        $flat->setPrice(4.50);
        $category = $this->getReference('fromages');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Plateau de fromage');
        $flat->setDescription('5 portions au choix');
        $flat->setPrice(6.50);
        $category = $this->getReference('fromages');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        //Desserts
        $flat = new Flat();
        $flat->setName('Fondue au chocolat');
        $flat->setDescription('fruits, biscuits et chamallow');
        $flat->setPrice(7.50);
        $category = $this->getReference('desserts');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Crème brulée');
        $flat->setDescription('caramel croquant');
        $flat->setPrice(5.50);
        $category = $this->getReference('desserts');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Île flottante');
        $flat->setDescription('crème anglaise, coulis de framboise');
        $flat->setPrice(5.80);
        $category = $this->getReference('desserts');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Tarte aux fruits rouges');
        $flat->setDescription('coulis de framboises, framboises fraîches');
        $flat->setPrice(5.95);
        $category = $this->getReference('desserts');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Tiramisu');
        $flat->setDescription('biscuits cuillère nappés de café');
        $flat->setPrice(6);
        $menu = $this->getReference('savoyard');
        $flat->setMenu($menu);
        $category = $this->getReference('desserts');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Salade de fruits');
        $flat->setDescription('fruits de saison');
        $flat->setPrice(6.50);
        $menu = $this->getReference('savoyard');
        $flat->setMenu($menu);
        $category = $this->getReference('desserts');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        $flat = new Flat();
        $flat->setName('Café ou déca gourmand');
        $flat->setDescription('selon vos envies');
        $flat->setPrice(4.50);
        $category = $this->getReference('desserts');
        $flat->setCategory($category);
        //On va chercher une ref de photo aléatoire
        $photo = $this->getReference('pht-' . rand(1, 20));
        $flat->setPhoto($photo);
        $manager->persist($flat);

        //horaires
        $hour = new Hour();
        $hour->setDayWeek('Lundi');
        $hour->setRestaurant($restaurant);
        $manager->persist($hour);
        $hour = new Hour();
        $hour->setDayWeek('Mardi');
        $hour->setRestaurant($restaurant);
        $manager->persist($hour);
        $hour = new Hour();
        $hour->setDayWeek('Mercredi');
        $hour->setRestaurant($restaurant);
        $manager->persist($hour);
        $hour = new Hour();
        $hour->setDayWeek('Jeudi');
        $hour->setLunchOpeningTime(new \DateTime('12:00:00'));
        $hour->setLunchClosingTime(new \DateTime('14:00:00'));
        $hour->setDinnerOpeningTime(new \DateTime('19:00:00'));
        $hour->setDinnerClosingTime(new \DateTime('22:00:00'));
        $hour->setRestaurant($restaurant);
        $manager->persist($hour);
        $hour = new Hour();
        $hour->setDayWeek('Vendredi');
        $hour->setLunchOpeningTime(new \DateTime('12:00:00'));
        $hour->setLunchClosingTime(new \DateTime('14:00:00'));
        $hour->setDinnerOpeningTime(new \DateTime('19:00:00'));
        $hour->setDinnerClosingTime(new \DateTime('22:00:00'));
        $hour->setRestaurant($restaurant);
        $manager->persist($hour);
        $hour = new Hour();
        $hour->setDayWeek('Samedi');
        $hour->setLunchOpeningTime(new \DateTime('12:00:00'));
        $hour->setLunchClosingTime(new \DateTime('14:00:00'));
        $hour->setDinnerOpeningTime(new \DateTime('19:00:00'));
        $hour->setDinnerClosingTime(new \DateTime('22:00:00'));
        $hour->setRestaurant($restaurant);
        $manager->persist($hour);
        $hour = new Hour();
        $hour->setDayWeek('Dimanche');
        $hour->setLunchOpeningTime(new \DateTime('12:00:00'));
        $hour->setLunchClosingTime(new \DateTime('14:00:00'));
        $hour->setDinnerOpeningTime(new \DateTime('19:00:00'));
        $hour->setDinnerClosingTime(new \DateTime('22:00:00'));
        $hour->setRestaurant($restaurant);
        $manager->persist($hour);

        
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