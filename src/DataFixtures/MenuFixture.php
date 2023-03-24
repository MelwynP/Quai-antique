<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Menu;
use App\Repository\FlatRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MenuFixture extends Fixture implements DependentFixtureInterface
{   
    public function __construct(
    private FlatRepository $flatRepository
    ){}

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($mnu = 1; $mnu <= 5; $mnu++){            
        $menu = new Menu();
        $menu->setName($faker->text(10));
        $menu->setDescription($faker->text(30));
        $menu->setPrice($faker->randomNumber(3));
        $manager->persist($menu);
        }

        $flat = $this->flatRepository->findAll();
        foreach($flat as $flat) {
        $menu->addFlat($flat);
        $manager->persist($flat);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RestaurantFixture::class,
        ];
    }
}
