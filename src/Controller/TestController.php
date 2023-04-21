<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class TestController extends AbstractController
{

  #[Route(path: '/ajax', name: 'ajax')]
  public function ajaxAction(): JsonResponse
  {

    // Traitez votre requête AJAX ici
    $data = ['message' => 'Hello World!'];

    // Retournez une réponse JSON
    return new JsonResponse($data);
  }


  #[Route(path: '/ajax-demo', name: 'ajax_demo')]
  public function ajaxDemoAction(): Response
  {
    return $this->render('ajax.html.twig');
  }
}
