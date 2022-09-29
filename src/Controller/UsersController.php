<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
  #[Route("/admin/inscription")]
  public function new(Request $request, ManagerRegistry $doctrine): Response
  {
    $users = new Users();

    $form = $this->createForm(UsersType::class, $users);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($users);
      // $entityManager = $doctrine->getManager();

      // $entityManager->persist($users);
      // $entityManager->flush();
    }

    return $this->render('admin/inscription.html.twig', [
      "form" => $form->createView()
    ]);
  }
}