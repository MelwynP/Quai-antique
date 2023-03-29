<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Faker;

class CategoryFixture extends Fixture
{
    private $counter = 1;
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($ctg=1; $ctg <=5 ; $ctg++) { 
        $category = new Category();
        $category->setName($faker->text(10));
        $manager->persist($category);
        $this->addReference('cat-' . $this->counter, $category);
        $this->counter++;
        }

        $manager->flush();
    }
}
