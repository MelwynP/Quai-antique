<?php

namespace App\Controller;

use App\Form\BookFormType;
use App\Entity\Booking;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{


    #[Route('/reservation', name: 'app_book')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $booking = new Booking(); // Créer une nouvelle réservation

        $bookForm = $this->createForm(BookFormType::class, $booking);

        $user = $this->getUser(); // Récupérer l'utilisateur connecté
        if ($user) { // Vérifie si l'utilisateur est connecté
            $bookForm->get('numberPeople')->setData($user->getNumberPeople());
            $bookForm->get('civility')->setData($user->getCivility());
            $bookForm->get('firstname')->setData($user->getFirstname());
            $bookForm->get('name')->setData($user->getName());
            $bookForm->get('phone')->setData($user->getPhone());
            $bookForm->get('email')->setData($user->getEmail());
            $bookForm->get('allergy')->setData($user->getAllergy());
        }

        //on récupère les données du form
        $bookForm->handleRequest($request);
        //on test avec diedump les données du form, c'est ok 
        //dd($bookForm);
        //on verifie si le formulaire est soumis et valide
        if ($bookForm->isSubmitted() && $bookForm->isValid()) {
            //on récupère les données du form
            $booking = $bookForm->getData();


            $em->persist($booking);
            $em->flush();
            // On redirige vers la page de confirmation
            return $this->redirectToRoute('app_book_confirm');
            // Aucun ou plusieurs champs horaires ont été sélectionnés
            $this->addFlash('danger', 'Veuillez choisir un seul horaire.');
        }

        // Afficher le formulaire de réservation avec les créneaux horaires disponibles
        return $this->render('book/index.html.twig', [
            'bookForm' => $bookForm->createView(),
        ]);
    }

    #[Route('/reservation/confirmation', name: 'app_book_confirm')]
    public function confirm(): Response
    {

        return $this->render('book/confirm.html.twig');
    }
}
