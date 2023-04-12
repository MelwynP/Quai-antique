<?php

namespace App\Controller\Admin;

use App\Entity\Hour;
use App\Repository\HourRepository;
use App\Form\HourForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/admin/horaire', name: 'admin_hour_')]

class HourController extends AbstractController
{
  #[Route('/', name: 'index')]

  public function index(HourRepository $hourRepository): Response
  {
    $hour = $hourRepository->findAll();

    return $this->render('admin/hour/index.html.twig', compact('hour'));
  }

  #[Route('/modifier/{id}', name: 'edit')]
  public function edit(Hour $hour, Request $request, EntityManagerInterface $em): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $hourFormulaire = $this->createForm(HourForm::class, $hour);
    $hourFormulaire->handleRequest($request);

    if ($hourFormulaire->isSubmitted() && $hourFormulaire->isValid()) {
      $em->flush();
      $this->addFlash('success', 'Heure modifiée avec succès');

      return $this->redirectToRoute('admin_hour_index');
    }

    return $this->render('admin/hour/edit.html.twig', [
      'hourFormulaire' => $hourFormulaire->createView()
    ]);
  }
}
