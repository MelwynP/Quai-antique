<?php

namespace App\Controller\Admin;

use App\Entity\Capacity;
use App\Form\CapacityForm;
use App\Repository\CapacityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/capacite', name: 'admin_capacity_')]
class CapacityController extends AbstractController
{
  #[Route('/', name: 'index')]

  public function index(CapacityRepository $capacityRepository): Response
  {
    $capacity = $capacityRepository->find(1);

    return $this->render('admin/capacity/index.html.twig', compact('capacity'));
  }

  #[Route('/modifier/{id}', name: 'edit')]
  public function edit(Capacity $capacity, Request $request, EntityManagerInterface $em): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $capacityFormulaire = $this->createForm(CapacityForm::class, $capacity);
    $capacityFormulaire->handleRequest($request);

    if ($capacityFormulaire->isSubmitted() && $capacityFormulaire->isValid()) {
      $em->flush();
      $this->addFlash('success', 'Capacité modifiée avec succès');

      return $this->redirectToRoute('admin_capacity_index');
    }

    return $this->render('admin/capacity/edit.html.twig', [
      'capacityFormulaire' => $capacityFormulaire->createView()
    ]);
  }
}
