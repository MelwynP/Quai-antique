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
            'saladPrefer' => $flatRepository->saladPrefer(),
            'flatPrefer' => $flatRepository->flatPrefer(),
            'cheesePrefer' => $flatRepository->cheesePrefer(),
            'dessertPrefer' => $flatRepository->dessertPrefer(),
            'dayClose' => $hourRepository->dayClose(),
            'dayOpen' => $hourRepository->dayOpen(),
            'photoSalad' => $photoRepository->photoSalad(),
            'photos' => $photoRepository->findAll([]),
           
        ]);
    }
}
