<?php

namespace App\Controller;

use App\Entity\Permissions;
use App\Form\PermissionsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionsController extends AbstractController
{
  #[Route("/admin/register/permission")]
  public function new(Request $request, ManagerRegistry $doctrine): Response
  {
    $permissions = new Permissions();
    $form = $this->createForm(PermissionsType::class, $permissions);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $doctrine->getManager();

      $entityManager->persist($permissions);
      $entityManager->flush();

      return $this->redirectToRoute('app_admin');
    }

    return $this->render('admin/registerPermission.html.twig', [
      "form" => $form->createView()
    ]);
  }
}