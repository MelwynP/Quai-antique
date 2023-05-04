<?php

namespace App\DataFixtures;

use App\Entity\Flat;
use App\Entity\Booking;
use App\Entity\Hour;
use App\Entity\Restaurant;
use App\Entity\Capacity;
use App\Entity\Images;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class RestaurantFixture extends Fixture implements DependentFixtureInterface
{

  public function load(ObjectManager $manager): void
  {

    $capacity = new Capacity();
    $capacity->setCapacityMaxLunch(60);
    $capacity->setCapacityMaxDinner(60);
    $capacity->setNumberTable(30);
    $capacity->setNumberChair(60);
    $manager->persist($capacity);

    $restaurant = new Restaurant();
    $restaurant->setName('Quai-Antique');
    $restaurant->setAddress('2 rue Favre');
    $restaurant->setPhone('0388888888');
    $restaurant->setEmail('contact@quai-antique.com');
    $restaurant->setAveragePrice(35.50);
    $restaurant->setCity('Chambéry');
    $restaurant->setZipCode(73000);
    $manager->persist($restaurant);


    $faker = Faker\Factory::create('fr_FR');

    for ($bkg = 1; $bkg <= 10; $bkg++) {
      $booking = new Booking();
      $booking->setDateReservation($faker->dateTimeBetween('now', '+1 week'));
      $booking->setServiceType($faker->randomElement(['Déjeuner', 'Dîner']));
      $booking->setHour($faker->randomElement(['12:00', '12:15', '12:30', '19:00', '19:15', '19:30', '19:45', '20:00']));
      $booking->setFirstname($faker->firstName);
      $booking->setName($faker->name);
      $booking->setEmail($faker->email);
      $booking->setPhone($faker->phoneNumber);
      $booking->setCivility($faker->randomElement(['Monsieur', 'Madame']));
      $booking->setNumberPeople($faker->numberBetween(2, 10));
      $booking->setAllergy($faker->text(20));
      $manager->persist($booking);
    }


    //Entrées
    $flat1 = new Flat();
    $flat1->setName('Salade gourmet');
    $flat1->setDescription('roquette, endives, tommates cerises, noix de cajou grillées, pignon de pin, fromage de chèvre, vinaigrette au miel');
    $flat1->setPrice(12.50);
    $category = $this->getReference('entrees');
    $flat1->setCategory($category);
    //j'associe l'image
    $image1 = new Images();
    $image1->setTitre('0b87215031316f2c612f85ac90990416.webp');
    $image1->setFlat($flat1);
    $manager->persist($image1);

    $manager->persist($flat1);

    $flat = new Flat();
    $flat->setName('Salade printanière');
    $flat->setDescription('mesclun, radis, asperges, comcombre, oeufs de caille, saumon fumé, feta, vinaigrette a l’huile d’olive');
    $flat->setPrice(12.00);
    $category = $this->getReference('entrees');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Soupe de crozets');
    $flat->setDescription('soupe traditionnelle avec crozets, lardons et fromage');
    $flat->setPrice(8.50);
    $menu = $this->getReference('savoyard');
    $flat->setMenu($menu);
    $category = $this->getReference('entrees');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Péla de pomme de terre');
    $flat->setDescription('pommes de terre, fromage à raclette, lardons');
    $flat->setPrice(8.50);
    $category = $this->getReference('entrees');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Diots');
    $flat->setDescription('saucisses de porc, vin blanc, oignons');
    $flat->setPrice(8.50);
    $menu = $this->getReference('savoyard');
    $flat->setMenu($menu);
    $category = $this->getReference('entrees');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Croûte aux morilles');
    $flat->setDescription('pâte a tarte, morilles fraîches, oignons, fromage râpé');
    $flat->setPrice(9.00);
    $category = $this->getReference('entrees');
    $flat->setCategory($category);

    $manager->persist($flat);

    //Burgers
    $flat = new Flat();
    $flat->setName('Burger végétarien');
    $flat->setDescription('steak végétal, laitue, tomate, oignon rouge, avocat, cheddar végétalien, sauce aux champignons ou sauce aux tomates');
    $flat->setPrice(16.00);
    $category = $this->getReference('burgers');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Burger');
    $flat->setDescription('steak de boeuf, laitue, tomate, oignon rouge, cheddar, sauce barbecue');
    $flat->setPrice(16.50);
    $category = $this->getReference('burgers');
    $flat->setCategory($category);

    $manager->persist($flat);

    //Plats
    $flat = new Flat();
    $flat->setName('Tartiflette');
    $flat->setDescription('pommes de terre, lardons, oignons et fromage à raclette');
    $flat->setPrice(15.50);
    $category = $this->getReference('plats');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Fondue savoyarde');
    $flat->setDescription('fromage fondue, pain, pommes de terre, charcuteries');
    $flat->setPrice(16.50);
    $menu = $this->getReference('savoyard');
    $flat->setMenu($menu);
    $category = $this->getReference('plats');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Fondue au gorgonzola');
    $flat->setDescription('fromage fondue gorgonzola, pain, pommes de terre, charcuteries');
    $flat->setPrice(16.50);
    $category = $this->getReference('plats');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Raclette');
    $flat->setDescription('fromage à raclette, pommes de terre, charcuterie et légumes');
    $flat->setPrice(16.00);
    $category = $this->getReference('plats');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Croziflette');
    $flat->setDescription('crozets, lardons, oignons et reblochon');
    $flat->setPrice(14.00);
    $menu = $this->getReference('savoyard');
    $flat->setMenu($menu);
    $category = $this->getReference('plats');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Entrecôte 240 à 260 gr');
    $flat->setDescription('sauce et accompagnement au choix');
    $flat->setPrice(16.50);
    $category = $this->getReference('plats');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat2 = new Flat();
    $flat2->setName('Filet de poisson grillé aux herbes');
    $flat2->setDescription('selon les saisons');
    $flat2->setPrice(16.50);
    $category = $this->getReference('plats');
    $flat2->setCategory($category);
    // j'associe l'image au plat
    $image2 = new Images();
    $image2->setTitre('71df7fdc97353589bbdf38f2324f8888.webp');
    $image2->setFlat($flat2);
    $manager->persist($image2);

    $manager->persist($flat2);

    //Fromages
    $flat = new Flat();
    $flat->setName('Fromage blanc au miel');
    $flat->setDescription('miel de Chambery');
    $flat->setPrice(4.50);
    $category = $this->getReference('fromages');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Fromage blanc aux framboises');
    $flat->setDescription('framboises fraîches');
    $flat->setPrice(4.20);
    $category = $this->getReference('fromages');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Plateau de fromage');
    $flat->setDescription('5 portions au choix');
    $flat->setPrice(6.50);
    $category = $this->getReference('fromages');
    $flat->setCategory($category);

    $manager->persist($flat);

    //Desserts
    $flat = new Flat();
    $flat->setName('Fondue au chocolat');
    $flat->setDescription('fruits, biscuits et chamallow');
    $flat->setPrice(7.00);
    $category = $this->getReference('desserts');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Crème brulée');
    $flat->setDescription('caramel croquant');
    $flat->setPrice(5.20);
    $category = $this->getReference('desserts');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Île flottante');
    $flat->setDescription('crème anglaise, coulis de framboise');
    $flat->setPrice(5.00);
    $category = $this->getReference('desserts');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Tarte aux fruits rouges');
    $flat->setDescription('coulis de framboises, framboises fraîches');
    $flat->setPrice(5.00);
    $category = $this->getReference('desserts');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Tiramisu');
    $flat->setDescription('biscuits cuillère nappés de café');
    $flat->setPrice(6.50);
    $menu = $this->getReference('savoyard');
    $flat->setMenu($menu);
    $category = $this->getReference('desserts');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Salade de fruits');
    $flat->setDescription('fruits de saison');
    $flat->setPrice(6.50);
    $menu = $this->getReference('savoyard');
    $flat->setMenu($menu);
    $category = $this->getReference('desserts');
    $flat->setCategory($category);

    $manager->persist($flat);

    $flat = new Flat();
    $flat->setName('Café ou déca gourmand');
    $flat->setDescription('selon vos envies');
    $flat->setPrice(4.20);
    $category = $this->getReference('desserts');
    $flat->setCategory($category);

    $manager->persist($flat);

    //horaires
    $hour = new Hour();
    $hour->setDayWeek('Lundi');
    $hour->setLunchOpeningTime('Fermé');
    $hour->setLunchClosingTime('Fermé');
    $hour->setDinnerOpeningTime('Fermé');
    $hour->setDinnerClosingTime('Fermé');
    $hour->setRestaurant($restaurant);
    $manager->persist($hour);
    $hour = new Hour();
    $hour->setDayWeek('Mardi');
    $hour->setLunchOpeningTime('Fermé');
    $hour->setLunchClosingTime('Fermé');
    $hour->setDinnerOpeningTime('Fermé');
    $hour->setDinnerClosingTime('Fermé');
    $hour->setRestaurant($restaurant);
    $manager->persist($hour);
    $hour = new Hour();
    $hour->setDayWeek('Mercredi');
    $hour->setLunchOpeningTime('Fermé');
    $hour->setLunchClosingTime('Fermé');
    $hour->setDinnerOpeningTime('Fermé');
    $hour->setDinnerClosingTime('Fermé');
    $hour->setRestaurant($restaurant);
    $manager->persist($hour);
    $hour = new Hour();
    $hour->setDayWeek('Jeudi');
    $hour->setLunchOpeningTime('12h00');
    $hour->setLunchClosingTime('14h00');
    $hour->setDinnerOpeningTime('19h00');
    $hour->setDinnerClosingTime('22h00');
    $hour->setRestaurant($restaurant);
    $manager->persist($hour);
    $hour = new Hour();
    $hour->setDayWeek('Vendredi');
    $hour->setLunchOpeningTime('12h00');
    $hour->setLunchClosingTime('14h00');
    $hour->setDinnerOpeningTime('19h00');
    $hour->setDinnerClosingTime('22h00');
    $hour->setRestaurant($restaurant);
    $manager->persist($hour);
    $hour = new Hour();
    $hour->setDayWeek('Samedi');
    $hour->setLunchOpeningTime('12h00');
    $hour->setLunchClosingTime('14h00');
    $hour->setDinnerOpeningTime('19h00');
    $hour->setDinnerClosingTime('22h00');
    $hour->setRestaurant($restaurant);
    $manager->persist($hour);
    $hour = new Hour();
    $hour->setDayWeek('Dimanche');
    $hour->setLunchOpeningTime('12h00');
    $hour->setLunchClosingTime('14h00');
    $hour->setDinnerOpeningTime('19h00');
    $hour->setDinnerClosingTime('22h00');
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
