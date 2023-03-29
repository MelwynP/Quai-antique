<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class MenuFixture extends Fixture
{
    private $counter = 1;
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($mnu = 1; $mnu <= 3; $mnu++){            
        $menu = new Menu();
        $menu->setName($faker->text(10));
        $menu->setDescription($faker->text(30));
        $menu->setPrice($faker->numberBetween(20, 60));
        $manager->persist($menu);
        $this->addReference('mnu-' . $this->counter, $menu);
        $this->counter++;
        }

        $manager->flush();
    }
}
