<?php

namespace App\Controller;

use App\Repository\FlatRepository;
use App\Repository\HourRepository;
use App\Repository\PhotoRepository;
use phpDocumentor\Reflection\Types\Mixed_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(FlatRepository $flatRepository, PhotoRepository $photoRepository, HourRepository $hourRepository): Response
    {
        return $this->render('main/index.html.twig',[
            'flats' => $flatRepository->findById([1,2]),
            'photos' => $photoRepository->findById([1, 2, 3]),
            'hours' => $hourRepository->findById([1, 2, 3, 4, 5, 6, 7]),

        ]);
    }
}
