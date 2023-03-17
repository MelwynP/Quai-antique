<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardMenuController extends AbstractController
{
    #[Route('/carte-menu', name: 'app_card_menu')]
    public function index(): Response
    {
        return $this->render('card_menu/index.html.twig');
    }
}
