<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/reservation', name: 'admin_reservation_')]

class BookingController extends AbstractController
{
  #[Route('/', name: 'index')]

  public function index(BookingRepository $bookingRepository, EntityManagerInterface $em): Response
  {
    $bookingOrder = $em->getRepository(Booking::class)
      ->createQueryBuilder('b')
      ->orderBy('b.dateReservation', 'ASC')
      ->getQuery()
      ->getResult();

    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    return $this->render('admin/reservation/index.html.twig', [
      'booking' => $bookingRepository->findAll(),
      'bookingOrder' => $bookingOrder
    ]);
  }

  #[Route('/supprimer/{id}', name: "delete")]
  public function delete(Booking $booking, EntityManagerInterface $em): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $em->remove($booking);
    $em->flush();

    $this->addFlash(
      'success',
      'Réservation supprimé avec succès'
    );

    return $this->redirectToRoute("admin_reservation_index");
  }
}
