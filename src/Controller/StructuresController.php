<?php

namespace App\Controller;

use App\Entity\Structures;
use App\Form\StructuresType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StructuresController extends AbstractController
{
  #[Route("/admin/register/structure")]
  public function new(Request $request, ManagerRegistry $doctrine): Response
  {
    $structures = new Structures();
    $form = $this->createForm(StructuresType::class, $structures);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $doctrine->getManager();

      $entityManager->persist($structures);
      $entityManager->flush();

      return $this->redirectToRoute("app_admin");
    }

    return $this->render("admin/registerStructure.html.twig", [
      "form" => $form->createView()
    ]);
  }
}