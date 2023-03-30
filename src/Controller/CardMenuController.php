<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\FlatRepository;
use App\Repository\HourRepository;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardMenuController extends AbstractController
{
    #[Route('/carte-menu', name: 'app_card_menu')]
    public function index(FlatRepository $flatRepository, CategoryRepository $categoryRepository, MenuRepository $menuRepository, HourRepository $hourRepository): Response
    {
        
        return $this->render('card_menu/index.html.twig',[
            'flats' => $flatRepository->findAll([]),
            'categories' => $categoryRepository->findAll([]),
            'menus' => $menuRepository->findAll(),
            'dayClose' => $hourRepository->dayClose(),
            'dayOpen' => $hourRepository->dayOpen(),
            'menuExpress' => $menuRepository->menuExpress(),
            'menuSavoyard' => $menuRepository->menuSavoyard(),
            'menuComplet' => $menuRepository->menuComplet(),
            'burger' => $categoryRepository->burger(),
            'dessert' => $categoryRepository->dessert(),

        ]);

    }
}
