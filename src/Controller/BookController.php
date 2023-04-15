<?php

namespace App\Controller;

use App\Form\BookFormType;
use App\Entity\Booking;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    #[Route('/reservation', name: 'app_book')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $booking = new Booking();
        //on associe la réservation à l'utilisateur
        //on crée un form de réservation
        $service = $request->query->get('service');

        $bookForm = $this->createForm(BookFormType::class, $booking);

        //on récupère les données du form
        $bookForm->handleRequest($request);
        //on test avec diedump les données du form, c'est ok 
        //dd($bookForm);
        //on verifie si le formulaire est soumis et valide
        if ($bookForm->isSubmitted() && $bookForm->isValid()) {

            $booking = $bookForm->getData();

            //on enregistre la réservation en bdd
            $em->persist($booking);
            $em->flush();
            //on redirige vers la page de confirmation
            return $this->redirectToRoute('app_book_confirm');
        }

        // Afficher le formulaire de réservation avec les créneaux horaires disponibles
        return $this->render('book/index.html.twig', [
            'bookForm' => $bookForm->createView(),
            'lunchHours' => ['12:00', '12:15', '12:30', '12:45', '13:00'], // heures pour le déjeuner
            'dinnerHours' => ['19:00', '19:15', '19:30', '19:45', '20:00'], // heures pour le dîner
            'service' => $service,

        ]);
    }



    #[Route('/reservation/confirmation', name: 'app_book_confirm')]
    public function confirm(): Response
    {

        return $this->render('book/confirm.html.twig');
    }
}
