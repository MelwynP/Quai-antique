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
    public function index(CategoryRepository $categoryRepository, FlatRepository $flatRepository,
    HourRepository $hourRepository, MenuRepository $menuRepository): Response
    {
        return $this->render('card_menu/index.html.twig',[
            'categories' => $categoryRepository->findById([1, 2, 3]),
            'flats' => $flatRepository->findById([1, 2, 3]),
            'hours' => $hourRepository->findById([1, 2, 3]),
            'menus' => $menuRepository->lastTree(),
        ]);
    }
}
