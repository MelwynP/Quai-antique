<?php

namespace App\Controller;

use App\Form\BookFormType;
use App\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{


    #[Route('/reservation', name: 'app_book')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $booking = new Booking();

        $bookForm = $this->createForm(BookFormType::class, $booking);

        $user = $this->getUser();
        if ($user) {
            $bookForm->get('numberPeople')->setData($user->getNumberPeople());
            $bookForm->get('civility')->setData($user->getCivility());
            $bookForm->get('firstname')->setData($user->getFirstname());
            $bookForm->get('name')->setData($user->getName());
            $bookForm->get('phone')->setData($user->getPhone());
            $bookForm->get('email')->setData($user->getEmail());
            $bookForm->get('allergy')->setData($user->getAllergy());
        }

        $bookForm->handleRequest($request);

        if ($bookForm->isSubmitted() && $bookForm->isValid()) {

            $booking = $bookForm->getData();


            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('app_book_confirm');
        }

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
