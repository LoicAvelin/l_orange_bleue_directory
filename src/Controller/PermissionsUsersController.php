<?php

namespace App\Controller;

use App\Entity\PermissionsUsers;
use App\Form\PermissionsUsersType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionsUsersController extends AbstractController
{
  #[Route("/admin/register/permissions-users")]
  public function new(Request $request, ManagerRegistry $doctrine): Response
  {
    $permission = new PermissionsUsers();
    $form = $this->createForm(PermissionsUsersType::class, $permission);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $doctrine->getManager();

      $entityManager->persist($permission);
      $entityManager->flush();

      return $this->redirectToRoute("app_admin");
    }

    return $this->render("admin/users/registerPermissionsUsers.html.twig", [
      "form" => $form->createView()
    ]);
  }
}