<?php

namespace App\Controller;

use App\Repository\FlatRepository;
use App\Repository\HourRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(FlatRepository $flatRepository, PhotoRepository $photoRepository, HourRepository $hourRepository): Response
    {
        return $this->render('main/index.html.twig',[
            'flatSalad' => $flatRepository->flatSalad(),
            'flatFlat' => $flatRepository->flatFlat(),
            'flatCheese' => $flatRepository->flatCheese(),
            'flatDessert' => $flatRepository->flatDessert(),
            'photoSalad' => $photoRepository->photoSalad(),
            'hours' => $hourRepository->findBy([]),

        ]);
    }
}
