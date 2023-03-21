<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookConfirmController extends AbstractController
{
    #[Route('/confirmation-reservation', name: 'app_book_confirm')]
    public function index(): Response
    {
        return $this->render('book_confirm/index.html.twig', [
            'controller_name' => 'BookConfirmController',
        ]);
    }
}
