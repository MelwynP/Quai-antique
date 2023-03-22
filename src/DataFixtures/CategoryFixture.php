<?php

namespace App\DataFixtures;

use App\Repository\FlatRepository;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture implements DependentFixtureInterface
{

     public function __construct(
            private FlatRepository $flatRepository
        ){}

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

        $flat = $this->flatRepository->findAll();
            foreach ($flat as $flat) {
                $category->addFlat($flat);
            }

        $manager->flush();

    }
        public function getDependencies(): array
        {
            return [
                RestaurantFixture::class,
            ];
        }
}
