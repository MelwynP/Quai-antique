<?php

namespace App\Controller\Admin;

use App\Entity\Flat;
use App\Entity\Images;
use App\Repository\FlatRepository;
use App\Form\FlatForm;
use App\Service\PictureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/admin/flat', name: 'admin_flat_')]

class FlatController extends AbstractController
{
    // Route accueil Admin Photo
    #[Route('/', name: 'index')]

    public function index(FlatRepository $flatRepository): Response
    {
        $flat = $flatRepository->findAll();
        return $this->render('admin/flat/index.html.twig', compact('flat'));
    }

    // Route ajout Flat Admin
    #[Route('/ajouter', name: 'add')]

    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        //On crée un nouvel objet Photo
        $flat = new Flat();

        //On crée le formulaire
        $flatFormulaire = $this->createForm(FlatForm::class, $flat);

        //On traite la requête du formulaire
        $flatFormulaire->handleRequest($request);

        if ($flatFormulaire->isSubmitted() && $flatFormulaire->isValid()) {
            // On récupère l'image
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



            $em->persist($flat);
            $em->flush();

            $this->addFlash('success', 'Produit ajouté avec succès');


            // On redirige vers la liste des photos
            return $this->redirectToRoute('admin_flat_index');
        }

        return $this->render('admin/flat/add.html.twig', [
            'flatFormulaire' => $flatFormulaire->createView()
        ]);
    }

    #[Route('/modifier/{id}', name: 'edit')]
    public function edit(Flat $flat, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');



        $flatFormulaire = $this->createForm(FlatForm::class, $flat);

        // On traite la requête du formulaire
        $flatFormulaire->handleRequest($request);

        //On vérifie si le formulaire est soumis ET valide
        if ($flatFormulaire->isSubmitted() && $flatFormulaire->isValid()) {
            // On récupère les images
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



            $em->persist($flat);
            $em->flush();

            $this->addFlash('success', 'Produit modifié avec succès');


            // On redirige
            return $this->redirectToRoute('admin_flat_index');
        }


        return $this->render('admin/flat/edit.html.twig', [
            'flatFormulaire' => $flatFormulaire->createView(),
            'flat' => $flat
        ]);
    }

    #[Route('/supprimer/{id}', name: 'delete')]
    public function delete(Flat $flat): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', $flat);


        return $this->render('admin/flat/index.html.twig');
    }

    #[Route('/supprimer/image/{id}', name: 'delete_image', methods: ['DELETE'])]
    public function deleteImage(Images $image, Request $request, EntityManagerInterface $em, PictureService $pictureService): JsonResponse
    {
        // On récupère le contenu de la requête
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])) {
            // Le token csrf est valide
            // On récupère le nom de l'image
            $nom = $image->getTitre();

            if ($pictureService->delete($nom, 'flats', 300, 300)) {
                // On supprime l'image de la base de données
                $em->remove($image);
                $em->flush();

                return new JsonResponse(['success' => true], 200);
            }
            // La suppression a échoué
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}
