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
      $allergies = [' - ', 'allergie aux oeufs', 'allergie au lactose', 'allergie aux arachides', 'allergie au gluten', 'allergie aux fruits de mer'];

      $booking = new Booking();
      $booking->setDateReservation($faker->dateTimeBetween(
        'now',
        '+1 week'
      )->modify('next saturday'));
      $booking->setServiceType($faker->randomElement(['Déjeuner']));
      $booking->setHour($faker->randomElement(['12:00', '12:15', '12:30', '12:45', '13:00']));
      $booking->setFirstname($faker->firstName);
      $booking->setName($faker->name);
      $booking->setEmail($faker->email);
      $booking->setPhone($faker->phoneNumber);
      $booking->setCivility($faker->randomElement(['Monsieur', 'Madame']));
      $booking->setNumberPeople($faker->numberBetween(2, 8));
      $booking->setAllergy($faker->randomElement($allergies));
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
    $image1->setTitre('44acaa43060f52222315caaae0f44113.webp');
    $image1->setFlat($flat1);
    $manager->persist($image1);
    $manager->persist($flat1);

    $flat3 = new Flat();
    $flat3->setName('Salade printanière');
    $flat3->setDescription('mesclun, radis, asperges, comcombre, oeufs de caille, saumon fumé, feta, vinaigrette a l’huile d’olive');
    $flat3->setPrice(12.00);
    $category = $this->getReference('entrees');
    $flat3->setCategory($category);
    //j'associe l'image
    $image3 = new Images();
    $image3->setTitre('c42c800e6c105c5b1c0c4983b33b58db.webp');
    $image3->setFlat($flat3);
    $manager->persist($image3);
    $manager->persist($flat3);

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
    $flat4 = new Flat();
    $flat4->setName('Burger végétarien');
    $flat4->setDescription('steak végétal, laitue, tomate, oignon rouge, avocat, cheddar végétalien, sauce aux champignons ou sauce aux tomates');
    $flat4->setPrice(16.00);
    $category = $this->getReference('burgers');
    $flat4->setCategory($category);
    //j'associe l'image
    $image4 = new Images();
    $image4->setTitre('309dd6d4455a74ca0db0f7e04bcf3e57.webp');
    $image4->setFlat($flat4);
    $manager->persist($image4);
    $manager->persist($flat4);

    $flat = new Flat();
    $flat->setName('Burger');
    $flat->setDescription('steak de boeuf, laitue, tomate, oignon rouge, cheddar, sauce barbecue');
    $flat->setPrice(16.50);
    $category = $this->getReference('burgers');
    $flat->setCategory($category);
    $manager->persist($flat);

    //Plats
    $flat5 = new Flat();
    $flat5->setName('Tartiflette');
    $flat5->setDescription('pommes de terre, lardons, oignons et fromage à raclette');
    $flat5->setPrice(15.50);
    $category = $this->getReference('plats');
    $flat5->setCategory($category);
    //j'associe l'image
    $image5 = new Images();
    $image5->setTitre('a44d553ca2544aa6ab111cf255283ed4.webp');
    $image5->setFlat($flat5);
    $manager->persist($image5);
    $manager->persist($flat5);

    $flat = new Flat();
    $flat->setName('Fondue savoyarde');
    $flat->setDescription('fromage fondue, pain, pommes de terre, charcuteries');
    $flat->setPrice(16.50);
    $menu = $this->getReference('savoyard');
    $flat->setMenu($menu);
    $category = $this->getReference('plats');
    $flat->setCategory($category);
    $manager->persist($flat);

    $flat6 = new Flat();
    $flat6->setName('Fondue au gorgonzola');
    $flat6->setDescription('fromage fondue gorgonzola, pain, pommes de terre, charcuteries');
    $flat6->setPrice(16.50);
    $category = $this->getReference('plats');
    $flat6->setCategory($category);
    //j'associe l'image
    $image6 = new Images();
    $image6->setTitre('d9eaf540b6d90e64ac09e50570cd5506.webp');
    $image6->setFlat($flat6);
    $manager->persist($image6);
    $manager->persist($flat6);

    $flat7 = new Flat();
    $flat7->setName('Raclette');
    $flat7->setDescription('fromage à raclette, pommes de terre, charcuterie et légumes');
    $flat7->setPrice(16.00);
    $category = $this->getReference('plats');
    $flat7->setCategory($category);
    //j'associe l'image
    $image7 = new Images();
    $image7->setTitre('534f3ded92bf8397004c8aca504a43ef.webp');
    $image7->setFlat($flat7);
    $manager->persist($image7);
    $manager->persist($flat7);

    $flat = new Flat();
    $flat->setName('Croziflette');
    $flat->setDescription('crozets, lardons, oignons et reblochon');
    $flat->setPrice(14.00);
    $menu = $this->getReference('savoyard');
    $flat->setMenu($menu);
    $category = $this->getReference('plats');
    $flat->setCategory($category);
    $manager->persist($flat);

    $flat8 = new Flat();
    $flat8->setName('Entrecôte 240 à 260 gr');
    $flat8->setDescription('sauce et accompagnement au choix');
    $flat8->setPrice(16.50);
    $category = $this->getReference('plats');
    $flat8->setCategory($category);
    //j'associe l'image
    $image8 = new Images();
    $image8->setTitre('36b5ede2387c669372b19b40551a0f84.webp');
    $image8->setFlat($flat8);
    $manager->persist($image8);
    $manager->persist($flat8);

    $flat2 = new Flat();
    $flat2->setName('Poisson grillé aux herbes');
    $flat2->setDescription('selon les saisons');
    $flat2->setPrice(16.50);
    $category = $this->getReference('plats');
    $flat2->setCategory($category);
    // j'associe l'image au plat
    $image2 = new Images();
    $image2->setTitre('46c7cfa543e8eedfb3b9c6a79822988a.webp');
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

    $flat9 = new Flat();
    $flat9->setName('Plateau de fromage');
    $flat9->setDescription('5 portions au choix');
    $flat9->setPrice(6.50);
    $category = $this->getReference('fromages');
    $flat9->setCategory($category);
    //j'associe l'image
    $image9 = new Images();
    $image9->setTitre('b0e33f468eff6d424a4402340d3b6b6f.webp');
    $image9->setFlat($flat9);
    $manager->persist($image9);
    $manager->persist($flat9);

    //Desserts
    $flat = new Flat();
    $flat->setName('Fondue au chocolat');
    $flat->setDescription('fruits, biscuits et chamallow');
    $flat->setPrice(7.00);
    $category = $this->getReference('desserts');
    $flat->setCategory($category);
    $manager->persist($flat);

    $flat10 = new Flat();
    $flat10->setName('Crème brulée');
    $flat10->setDescription('caramel croquant');
    $flat10->setPrice(5.20);
    $category = $this->getReference('desserts');
    $flat10->setCategory($category);
    //j'associe l'image
    $image10 = new Images();
    $image10->setTitre('f018cb647959343b508cd63afebddf4c.webp');
    $image10->setFlat($flat10);
    $manager->persist($image10);
    $manager->persist($flat10);

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

    $flat11 = new Flat();
    $flat11->setName('Tiramisu');
    $flat11->setDescription('biscuits cuillère nappés de café');
    $flat11->setPrice(6.50);
    $menu = $this->getReference('savoyard');
    $flat11->setMenu($menu);
    $category = $this->getReference('desserts');
    $flat11->setCategory($category);
    //j'associe l'image
    $image11 = new Images();
    $image11->setTitre('ff2a86213e2c4ea2472cfb1d1df7fcdd.webp');
    $image11->setFlat($flat11);
    $manager->persist($image11);
    $manager->persist($flat11);

    $flat12 = new Flat();
    $flat12->setName('Salade de fruits');
    $flat12->setDescription('fruits de saison');
    $flat12->setPrice(6.50);
    $menu = $this->getReference('savoyard');
    $flat12->setMenu($menu);
    $category = $this->getReference('desserts');
    $flat12->setCategory($category);
    //j'associe l'image
    $image12 = new Images();
    $image12->setTitre('c566f0866f7b7a93f0424f330c626f54.webp');
    $image12->setFlat($flat12);
    $manager->persist($image12);
    $manager->persist($flat12);

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
