<?php

namespace App\Controller;

use App\Form\BookFormType;
use App\Entity\Booking;
use App\Entity\Capacity;
use DateTime;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class BookController extends AbstractController
{

    #[Route('/reservation', name: 'app_book')]


    public function index(Request $request, EntityManagerInterface $em, BookingRepository $bookingRepository): Response
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

            $capacity = $em->getRepository(Capacity::class)->find(1);
            //$booking->setCapacity($capacity);

            $dateReservation = $booking->getDateReservation();

            // On récupère l'heure choisie par l'utilisateur
            $hour = $booking->getHour();

            if ($hour >= '11:00' && $hour <= '14:00') {
                $capacity = $em->getRepository(Capacity::class)->findOneBy(['capacityType' => 'lunch']);
                $capacity->setCapacityType('lunch');
            } elseif ($hour >= '18:00' && $hour <= '21:00') {
                $capacity = $em->getRepository(Capacity::class)->findOneBy(['capacityType' => 'dinner']);
                $capacity->setCapacityType('dinner');
            } else {
                // Erreur, le créneau ne correspond ni au lunch ni au dîner
            }

            if ($capacity) {
                if ($booking->getNumberPeople() > $capacity->getCapacityAvailable()) {
                    // Capacité insuffisante
                    $this->addFlash('danger', 'Capacité insuffisante pour ce créneau horaire');
                } else {
                    // Capacité suffisante
                    $booking->setCapacity($capacity);
                    $em->persist($booking);
                    $em->flush();

                    // Mise à jour de la capacité disponible
                    $capacity->setCapacityAvailable($capacity->getCapacityAvailable() - $booking->getNumberPeople());
                    $em->persist($capacity);
                    $em->flush();

                    $this->addFlash('success', 'Réservation enregistrée');
                    return $this->redirectToRoute('app_book_index');
                }
            } else {
                $this->addFlash('danger', 'Le créneau ne correspond ni au lunch ni au dîner');
            }

            /*
            $dateTime = new DateTime();
            if ($dateTime->format('H:i') >= '11:00' && $dateTime->format('H:i') <= '14:00') {
                $capacity = $em->getRepository(Capacity::class)->find(1);
                $booking->setCapacity($capacity->getCapacityMaxLunch());
                $capacity->setCapacityAvailableLunch($capacity->getCapacityAvailableLunch() - $booking->getNumberPeople());
            } elseif ($dateTime->format('H:i') >= '18:00' && $dateTime->format('H:i') <= '21:00') {
                // Le créneau est entre 19h00 et 21h00, on considère que c'est le dîner
                $capacity = $em->getRepository(Capacity::class)->find(1);
                $booking->setCapacity($capacity->getCapacityMaxDinner());

                //                $booking->setCapacity($capacityMaxDinner);
                $capacity->setCapacityAvailableDinner($capacity->getCapacityAvailableDinner() - $booking->getNumberPeople());
            } else {
                if ($booking->getCapacity() === null) {
                    $this->addFlash('danger', 'Le créneau ne correspond ni au lunch ni au dîner');
                }

                $this->addFlash('danger', 'Le créneau ne correspond ni au lunch ni au dîner');
            }
            */


            
            return $this->redirectToRoute('app_book_confirm');
        }
        return $this->render('book/index.html.twig', [
            'bookForm' => $bookForm->createView(),
        ]);
    }


    private function getCapacityByHour(EntityManagerInterface $em, $hour): ?Capacity
    {
        $capacityType = null;

        if ($hour >= '11:00' && $hour <= '14:00') {
            $capacityType = 'lunch';
        } elseif ($hour >= '18:00' && $hour <= '21:00') {
            $capacityType = 'dinner';
        } else {
            // Erreur, le créneau ne correspond ni au lunch ni au dîner
            return null;
        }

        $capacity = $em->getRepository(Capacity::class)->findOneBy(['capacityType' => $capacityType]);
        return $capacity;
    }


    #[Route('/reservation/confirmation', name: 'app_book_confirm')]
    public function confirm(): Response
    {

        return $this->render('book/confirm.html.twig');
    }
}
