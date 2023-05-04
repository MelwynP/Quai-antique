<?php

namespace App\Controller;

use App\Repository\FlatRepository;
use App\Repository\HourRepository;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(FlatRepository $flatRepository, ImagesRepository $imagesRepository, HourRepository $hourRepository): Response
    {

        return $this->render('main/index.html.twig', [
            'dayClose' => $hourRepository->dayClose(),
            'dayOpen' => $hourRepository->dayOpen(),
            'hour' => $hourRepository->findAll(),
            'flat' => $flatRepository->findAll(),
            'images' => $imagesRepository->findAll(),
        ]);
    }
}
