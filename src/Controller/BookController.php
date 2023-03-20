<?php

namespace App\Controller;

use App\Form\BookFormType;
use App\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/reservation', name: 'app_book')]
    public function index(): Response
    {
        //on créé une nouvelle réservation
        $booking = new Booking();
        //on crée un form de réservation
        $bookForm = $this->createForm(BookFormType::class, $booking);

        return $this->render('book/index.html.twig',[
            'bookForm' => $bookForm->createView()
        ]);
    }
}
