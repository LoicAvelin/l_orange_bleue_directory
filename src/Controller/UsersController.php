<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
  #[Route("/inscription")]
  public function new(): Response
  {
    $users = new Users();

    $form = $this->createForm(UsersType::class, $users);

    return $this->render('pages/inscription.html.twig', [
      "form" => $form->createView()
    ]);
  }
}