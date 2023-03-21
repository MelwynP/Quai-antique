<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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

        $manager->flush();
    }
}
