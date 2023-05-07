<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MenuFixture extends Fixture
{
  public function load(ObjectManager $manager): void
  {

    $menu = new Menu();
    $menu->setName('Express');
    $menu->setDescription('Formule servie lors du déjeuner');
    $menu->setPrice(21);
    $manager->persist($menu);
    $this->addReference('express', $menu);

    $menu = new Menu();
    $menu->setName('Savoyard');
    $menu->setDescription('Notre terroir en bouche');
    $menu->setPrice(27);
    $manager->persist($menu);
    $this->addReference('savoyard', $menu);

    $menu = new Menu();
    $menu->setName('Complet');
    $menu->setDescription('Pour ne rien oublier');
    $menu->setPrice(35);
    $manager->persist($menu);
    $this->addReference('complet', $menu);


    $manager->flush();
  }
}
