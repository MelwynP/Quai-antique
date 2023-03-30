<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $category = new Category();
        $category->setName('Entrées');
        $manager->persist($category);
        $this->addReference('entrees', $category);
        
        $category = new Category();
        $category->setName('Burgers');
        $manager->persist($category);
        $this->addReference('burgers', $category);
        
        $category = new Category();
        $category->setName('Plats');
        $manager->persist($category);
        $this->addReference('plats', $category);
        
        $category = new Category();
        $category->setName('Fromages');
        $manager->persist($category);
        $this->addReference('fromages', $category);
        
        $category = new Category();
        $category->setName('Desserts');
        $manager->persist($category);
        $this->addReference('desserts', $category);
        

        $manager->flush();
    }
}
