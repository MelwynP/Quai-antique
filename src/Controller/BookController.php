<?php

namespace App\Controller;

use App\Form\BookFormType;
use App\Entity\User;

use App\Entity\Booking;
use App\Entity\Capacity;
use App\Repository\BookingRepository;
use App\Repository\CapacityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    #[Route('/reservation', name: 'app_book')]

    public function index(Request $request, EntityManagerInterface $em, CapacityRepository $capacityRepository, BookingRepository $bookingRepository): Response
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

        // if ($user) {
        //     $userData = self::getUserConnected($user);
        //     foreach ($userData as $key => $value) {
        //         $bookForm->get($key)->setData($value);
        //     }
        // }

        $bookForm->handleRequest($request);

        if ($bookForm->isSubmitted() && $bookForm->isValid()) {

            $serviceType = $bookForm->get('serviceType')->getData();
            $dateReservation = $bookForm->get('dateReservation')->getData();
            $numberPeople = $bookForm->get('numberPeople')->getData();

            if (self::isFull($serviceType, $dateReservation, $numberPeople, $bookingRepository, $capacityRepository)) { // si on est plein
                $this->addFlash('danger', 'La capacité maximale est atteinte pour la date ' . $dateReservation->format('d-m-Y') . ' pour le ' . $serviceType . ' !');
            } else {
                $em->persist($booking);
                $em->flush();
                return $this->redirectToRoute("app_book_confirm");
            }
        }
        return $this->render('book/index.html.twig', [
            'bookForm' => $bookForm->createView(),
        ]);
    }


    //-------------------
    // Fonction pour récupérer le nombre de réservations pour un service donné
    public static function getTotalBooking($serviceType, $dateReservation, BookingRepository $bookingRepository) // number of reservations for a given date and service type
    {
        $ret = 0;
        $bookings = new Booking();
        $bookings = $bookingRepository->findAll();
        foreach ($bookings as $booking) {
            if ($booking->getDateReservation()->format('d-m-Y') == $dateReservation->format('d-m-Y')) {
                if ($booking->getServiceType() == $serviceType) {
                    $ret += $booking->getNumberPeople();
                }
            }
        }
        // $booking = getBookings($currentDate, $serviceType);
        return $ret;
    }


    //-------------------
    // Fonction pour récupérer la capacité maximale
    public static function getCapacity($serviceType, CapacityRepository $capacityRepository)
    {
        $capacity = new Capacity();
        $capacity = $capacityRepository->find(1);
        $ret = 0;
        // $ret = $capacity->getCapacity($serviceType);
        if ($serviceType == "Déjeuner") {
            $ret = $capacity->getCapacityMaxLunch();
        } else if ($serviceType == "Dîner") {
            $ret = $capacity->getCapacityMaxDinner();
        } else {
            $ret = 0;
        }
        return $ret;
    }


    //-------------------
    // Fonction pour vérifier si le restaurant est complet
    public static function isFull($serviceType, $dateReservation, $numberPeople, $bookingRepository, $capacityRepository)
    {
        $ret = false; // de base, on considère que le restaurant n'est pas complet
        $totalBooking = self::getTotalBooking($serviceType, $dateReservation, $bookingRepository);
        $capacity = self::getCapacity($serviceType, $capacityRepository);
        if ($totalBooking + $numberPeople > $capacity) {
            $ret = true;
        }
        return $ret;
    }


    //-------------------
    // Fonctions pour récupérer les données de l'utilisateur connecté
    // public static function getUserConnected(User $user): array
    // {
    //     $userData = [
    //         'numberPeople' => $user->getNumberPeople(),
    //         'civility' => $user->getCivility(),
    //         'firstname' => $user->getFirstname(),
    //         'name' => $user->getName(),
    //         'phone' => $user->getPhone(),
    //         'email' => $user->getEmail(),
    //         'allergy' => $user->getAllergy(),
    //     ];
    //     return $userData;
    // }


    //-------------------
    // Route pour la page de confirmation
    #[Route('/reservation/confirmation', name: 'app_book_confirm')]
    public function confirm(): Response
    {
        return $this->render('book/confirm.html.twig');
    }

    //-------------------
    // Route pour la requête fetch
    #[Route('/reservation/check-availability/{serviceType}/{dateReservation}/{numberPeople}')]
    public function isFullApi(Request $request, EntityManagerInterface $entityManager, BookingRepository $bookingRepository, CapacityRepository $capacityRepository)
    {
        // Récupérer les paramètres de la requête
        $serviceType = $request->attributes->get('serviceType');
        $dateReservation = new \DateTime($request->attributes->get('dateReservation'));
        $numberPeople = $request->attributes->get('numberPeople');

        // Récupérer les repositories nécessaires
        $bookingRepository = $entityManager->getRepository(Booking::class);
        $capacityRepository = $entityManager->getRepository(Capacity::class);

        // Pas besoin d'appeler la fonction getCapacity() car on a déjà la capacité max dans le paramètre $numberPeople
        // Appeler la fonction getTotalBooking()
        // $getTotalBooking = BookController::getTotalBooking($serviceType, $dateReservation, $bookingRepository);
        // Appeler la fonction getCapacity()
        // $getCapacity = BookController::getCapacity($serviceType, $capacityRepository);

        // Appeler la fonction isFull()
        $isFull = BookController::isFull($serviceType, $dateReservation, $numberPeople, $bookingRepository, $capacityRepository);



        // Retourner la réponse en JSON
        return new JsonResponse([
            // 'getCapacity' => $getCapacity,
            // 'getTotalBooking' => $getTotalBooking,
            'isFull' => $isFull,

        ]);
    }



    //CA fonctionne pour le test
    // public function requete(BookingRepository $bookingRepository): JsonResponse
    // {
    //     $bookings = $bookingRepository->findAll();
    //     $bookingsData = [];

    //     foreach ($bookings as $booking) {
    //         $bookingsData[] = [
    //             'name' => $booking->getName(),
    //             'firstname' => $booking->getFirstname(),
    //             // ... ajoutez d' champs de la réservation ici
    //         ];
    //     }
    //     return new JsonResponse($bookingsData);
    // }






    // FUNCTION A REVOIR
    // public function isUserConnected($controller, $bookForm)
    // {
    //     $user = $controller->getUser();
    //     if ($user) {
    //         $bookForm->get('numberPeople')->setData($user->getNumberPeople());
    //         $bookForm->get('civility')->setData($user->getCivility());
    //         $bookForm->get('firstname')->setData($user->getFirstname());
    //         $bookForm->get('name')->setData($user->getName());
    //         $bookForm->get('phone')->setData($user->getPhone());
    //         $bookForm->get('email')->setData($user->getEmail());
    //         $bookForm->get('allergy')->setData($user->getAllergy());
    //     }
    // }
}
