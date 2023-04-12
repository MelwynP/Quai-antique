<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use App\Form\MenuForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/admin/menu', name: 'admin_menu_')]

class MenuController extends AbstractController
{
  #[Route('/', name: 'index')]

  public function index(MenuRepository $menuRepository): Response
  {
    $menu = $menuRepository->findAll();
    return $this->render('admin/menu/index.html.twig', compact('menu'));
  }

  #[Route('/ajouter', name: 'add')]

  public function add(Request $request, EntityManagerInterface $em): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    //On crée un nouvel objet Photo
    $menu = new Menu();

    //On crée le formulaire
    $menuFormulaire = $this->createForm(MenuForm::class, $menu);

    //On traite la requête du formulaire
    $menuFormulaire->handleRequest($request);

    if ($menuFormulaire->isSubmitted() && $menuFormulaire->isValid()) {


      $mnu = new Menu();
      $mnu->setName($menuFormulaire->get('name')->getData());
      $mnu->setDescription($menuFormulaire->get('description')->getData());
      $mnu->setPrice($menuFormulaire->get('price')->getData());

      $em->persist($mnu);
      $em->flush();

      $this->addFlash('success', 'Menu ajouté avec succès');

      // On redirige vers la liste des photos
      return $this->redirectToRoute('admin_menu_index');
    }

    return $this->render('admin/menu/add.html.twig', [
      'menuFormulaire' => $menuFormulaire->createView()
    ]);
  }

  /*
  #[Route('/edition/{id}', name: 'edit')]
  public function edit(Flat $flat, Request $request, EntityManagerInterface $em, PictureService $pictureService): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    // On crée le formulaire
    $flatFormulaire = $this->createForm(FlatForm::class, $flat);

    // On traite la requête du formulaire
    $flatFormulaire->handleRequest($request);

    //On vérifie si le formulaire est soumis ET valide
    if ($flatFormulaire->isSubmitted() && $flatFormulaire->isValid()) {

      foreach ($flat->getImages() as $image) {
        // Supprime l'image du dossier
        $pictureService->delete($image->getTitre());
        // Supprime l'image de la collection
        // $flat->removeImage($image);
        $flat->getImages()->removeElement($image);
      }

      $images = $flatFormulaire->get('images')->getData();

      foreach ($images as $image) {
        // On définit le dossier de destination
        $folder = 'flats';

        // On appelle le service d'ajout
        $fichier = $pictureService->add($image, $folder, 300, 300);

        $img = new Images();
        $img->setTitre($fichier);
        $flat->addImage($img);
      }

      // On stocke
      $em->persist($flat);
      $em->flush();

      $this->addFlash(
        'success',
        'Produit modifié avec succès'
      );

      // On redirige
      return $this->redirectToRoute('admin_flat_index');
    }

    return $this->render('admin/flat/edit.html.twig', [
      'flatFormulaire' => $flatFormulaire->createView(),
      'flat' => $flat
    ]);
  }

  #[Route('/supprimer/{id<\d+>}', name: "delete")]
  public function delete(Flat $flat, ManagerRegistry $doctrine): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $em = $doctrine->getManager();
    $em->remove($flat);
    $em->flush();

    $this->addFlash(
      'success',
      'Produit supprimé avec succès'
    );

    return $this->redirectToRoute("admin_flat_index");
  }
  */
}
