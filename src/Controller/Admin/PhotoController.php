<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PhotoFormType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

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

  public function add(Request $request, EntityManagerInterface $entityManager, PictureService $pictureService, SluggerInterface $slugger): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    //On crée un nouvel objet Photo
    $photo = new Photo();

    //On crée le formulaire
    $photoForm = $this->createForm(PhotoFormType::class, $photo);

    //On traite la requête du formulaire
    $photoForm->handleRequest($request);

    if ($photoForm->isSubmitted() && $photoForm->isValid()) {
      // On récupère l'image
      $image = $photoForm->get('image')->getData();

      foreach ($image as $image){
        // On définit le dossier de destination
        $folder = 'uploads';

        // On appel le service d'ajout
        $fichier = $pictureService->add($image, $folder, 300, 300);

        $img = new Photo();
                $img->setName($fichier);
                $photo->addImage($img);

      }


      // On vérifie si une image a été uploadée
      if ($image) {
        // On génère un nouveau nom de fichier
        $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
        // dd($newFilename);      
        try {
          $image->move('uploads',
            $newFilename
          );
        } catch (FileException $e) {
          dump($e);
        }

        // On met à jour le nom de l'image dans l'entité Photo
        $photo->setImage($newFilename);
      }

      // On enregistre l'entité Photo en base de données
      $entityManager->persist($photo);
      $entityManager->flush();

      // On redirige vers la liste des photos
      return $this->redirectToRoute('admin_photo_index');
    }

    return $this->render('admin/photo/add.html.twig', [
      'photoForm' => $photoForm->createView()
    ]);
  }

  #[Route('/modifier/{id}', name: 'edit')]

  public function edit(request $request, EntityManagerInterface $entityManager, Photo $photo, SluggerInterface $slugger): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    //On crée le formulaire
    $photoForm = $this->createForm(PhotoFormType::class, $photo);

    //On traite la requête du formulaire
    $photoForm->handleRequest($request);
    // dd($photoForm);

    if ($photoForm->isSubmitted() && $photoForm->isValid()) {
      // On récupère l'image
      $image = $photoForm->get('images')->getData();

      // On vérifie si une image a été uploadée
      if ($image) {
        // On génère un nouveau nom de fichier
        $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
        // dd($newFilename);      
        try {
          $image->move('uploads',
            $newFilename
          );
        } catch (FileException $e) {
          dump($e);
        }

        // On met à jour le nom de l'image dans l'entité Photo
        $photo->setImage($newFilename);
      }

      // On enregistre l'entité Photo en base de données
      $entityManager->persist($photo);
      $entityManager->flush();

       // On redirige vers la liste des photos
      return $this->redirectToRoute('admin_photo_index');
    }

    return $this->render('admin/photo/edit.html.twig', [
      'photoForm' => $photoForm->createView()
    ]);
  }


  #[Route('/supprimer/{id}', name: 'delete')]

  public function delete(EntityManagerInterface $entityManager, Photo $photo): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    // On supprime l'entité Photo en base de données
      $entityManager->remove($photo);

      $entityManager->flush();

       // On redirige vers la liste des photos
      return $this->redirectToRoute('admin_photo_index');
    }
}
