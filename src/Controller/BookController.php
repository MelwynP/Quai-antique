<?php

namespace App\Controller;

use App\Form\BookFormType;
use App\Entity\Booking;
use App\Entity\Capacity;
use App\Repository\BookingRepository;
use App\Repository\CapacityRepository;
use App\Repository\UserRepository;
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

        //function a remettre en place 
        // $userConnected = $this->isUserConnected($this, $bookForm);

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
            //'userConnected' => $userConnected,
        ]);
    }

    public static function getTotalBooking($serviceType, $dateReservation, BookingRepository $bookingRepository) // number of reservations for a given date and service type
    {
        $ret = 0;
        $bookings = new Booking();
        $bookings = $bookingRepository->findAll();
        foreach ($bookings as $booking) {
            if ($booking->getDateReservation()->format('Y-m-d') == $dateReservation->format('Y-m-d')) {
                if ($booking->getServiceType() == $serviceType) {
                    $ret += $booking->getNumberPeople();
                }
            }
        }
        // $booking = getBookings($currentDate, $serviceType);
        return $ret;
    }

    public static function getCapacity($serviceType, CapacityRepository $capacityRepository)
    {
        $capacity = new Capacity();
        $capacity = $capacityRepository->find(1);
        $ret = 0;
        // $ret = $capacity->getCapacity($serviceType);
        if ($serviceType == "lunch") {
            $ret = $capacity->getCapacityMaxLunch();
        } else if ($serviceType == "dinner") {
            $ret = $capacity->getCapacityMaxDinner();
        } else {
            $ret = 0;
        }
        return $ret;
    }

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



    #[Route('/reservation/confirmation', name: 'app_book_confirm')]
    public function confirm(): Response
    {
        return $this->render('book/confirm.html.twig');
    }


    #[Route('/reservation/requete', name: 'app_book_cancel')]
    public function requete(BookingRepository $bookingRepository, CapacityRepository $capacityRepository): JsonResponse
    {
        $bookings = $bookingRepository->findAll();
        $capacities = $capacityRepository->findAll();
        $bookingsData = [];
        $capacitiesData = [];

        foreach ($bookings as $booking) {
            $bookingsData[] = [
                'name' => $booking->getName(),
                'firstname' => $booking->getFirstname(),
            ];
        }

        foreach ($capacities as $capacity) {
            $capacitiesData[] = [
                'capacityMaxLunch' => $capacity->getCapacityMaxLunch(),
                'capacityMaxDinner' => $capacity->getCapacityMaxDinner(),
            ];
        }

        $responseData = [
            'capacities' => $capacitiesData,
            'bookings' => $bookingsData
        ];

        return new JsonResponse($responseData);
    }

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
