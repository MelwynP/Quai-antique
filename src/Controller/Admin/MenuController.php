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

    //On crée un nouvel objet Menu
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


  #[Route('/modifier/{id}', name: 'edit')]
  public function edit(Request $request, EntityManagerInterface $em, $id): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    // On récupère le menu à modifier
    $menu = $em->getRepository(Menu::class)->find($id);

    // On crée le formulaire en passant l'objet Menu à modifier
    $menuFormulaire = $this->createForm(MenuForm::class, $menu);

    // On traite la requête du formulaire
    $menuFormulaire->handleRequest($request);

    //On vérifie si le formulaire est soumis ET valide
    if ($menuFormulaire->isSubmitted() && $menuFormulaire->isValid()) {

      // On met à jour les données du menu
      $menu->setName($menuFormulaire->get('name')->getData());
      $menu->setDescription($menuFormulaire->get('description')->getData());
      $menu->setPrice($menuFormulaire->get('price')->getData());

      $em->flush();

      $this->addFlash('success', 'Menu modifié avec succès');

      // On redirige vers la liste des photos
      return $this->redirectToRoute('admin_menu_index');
    }

    return $this->render('admin/menu/add.html.twig', [
      'menuFormulaire' => $menuFormulaire->createView()
    ]);
  }

  #[Route('/supprimer/{id}', name: "delete")]
  public function delete(Menu $menu, EntityManagerInterface $em): Response
  {
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    try {
      $em->remove($menu);
      $em->flush();
      $this->addFlash(
        'success',
        'Menu supprimé avec succès'
      );
    } catch (\Exception $e) {
      $this->addFlash(
        'danger',
        'Impossible de supprimer le menu. Il est probablement utilisé avec d\'autres plats. Supprimer ou basculer ces plats avant de supprimer le menu.'
      );
    }

    return $this->redirectToRoute("admin_menu_index");
  }
}
