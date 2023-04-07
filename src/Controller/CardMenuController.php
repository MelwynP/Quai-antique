<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\FlatsRepository;
use App\Repository\HourRepository;
use App\Repository\MenusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardMenuController extends AbstractController
{
    #[Route('/carte-menu', name: 'app_card_menu')]
    public function index(FlatsRepository $flatsRepository, CategoriesRepository $categoriesRepository, MenusRepository $menusRepository, HourRepository $hourRepository): Response
    {
        
        return $this->render('card_menu/index.html.twig',[
            'flats' => $flatsRepository->findAll([]),
            'categories' => $categoriesRepository->findAll([]),
            'menus' => $menusRepository->findAll(),
            'dayClose' => $hourRepository->dayClose(),
            'dayOpen' => $hourRepository->dayOpen(),
            'menuExpress' => $menusRepository->menuExpress(),
            'menuSavoyard' => $menusRepository->menuSavoyard(),
            'menuComplet' => $menusRepository->menuComplet(),
        ]);

    }
}
