<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PhotoFormType;

#[Route('/admin/photo', name: 'admin_photo_')]
class PhotoController extends AbstractController
{
  #[Route('/', name: 'index')]

  public function index(): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    return $this->render('admin/photo/index.html.twig');
  }

  #[Route('/ajouter', name: 'add')]

  public function add(): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    //On crée un nouvel objet Photo
    $photo = new Photo();

    //On crée le formulaire
    $photoForm = $this->createForm(PhotoFormType::class, $photo);

    return $this->render('admin/photo/add.html.twig', [
      'photoForm' => $photoForm->createView()
    ]);
  }

  #[Route('/modifier/{id}', name: 'edit')]

  public function edit(): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    return $this->render('admin/photo/edit.html.twig');
  }

  #[Route('/supprimer/{id}', name: 'delete')]

  public function delete(): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    return $this->render('admin/photo/delete.html.twig');
  }
}
