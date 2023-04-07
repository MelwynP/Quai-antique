<?php

namespace App\Controller;

use App\Entity\Flat;
use App\Repository\FlatRepository;
use App\Repository\HourRepository;
use App\Repository\ImagesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(FlatRepository $flatRepository, ImagesRepository $imagesRepository, HourRepository $hourRepository): Response
    {

        return $this->render('main/index.html.twig', [
            'saladPrefer' => $flatRepository->saladPrefer(),
            'flatPrefer' => $flatRepository->flatPrefer(),
            'cheesePrefer' => $flatRepository->cheesePrefer(),
            'dessertPrefer' => $flatRepository->dessertPrefer(),
            'dayClose' => $hourRepository->dayClose(),
            'dayOpen' => $hourRepository->dayOpen(),


        ]);
    }
}
