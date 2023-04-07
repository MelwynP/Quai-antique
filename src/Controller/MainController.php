<?php

namespace App\Controller;

use App\Repository\FlatsRepository;
use App\Repository\HourRepository;
use App\Repository\PhotosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(FlatsRepository $flatsRepository, PhotosRepository $photosRepository, HourRepository $hourRepository): Response
    {
        
        return $this->render('main/index.html.twig',[
            'saladPrefer' => $flatsRepository->saladPrefer(),
            'flatPrefer' => $flatsRepository->flatPrefer(),
            'cheesePrefer' => $flatsRepository->cheesePrefer(),
            'dessertPrefer' => $flatsRepository->dessertPrefer(),
            'dayClose' => $hourRepository->dayClose(),
            'dayOpen' => $hourRepository->dayOpen(),
            'photos' => $photosRepository->findAll([]),
           
        ]);
    }

}