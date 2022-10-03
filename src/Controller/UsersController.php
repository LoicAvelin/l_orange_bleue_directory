<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
  #[Route("/admin/register/user", name: "admin_home")]
  public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher, ManagerRegistry $doctrine): Response
  {
    $user = new Users();
    $form = $this->createForm(UsersType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // encode the plain password
      $user->setPassword(
        $userPasswordHasher->hashPassword(
          $user, 
          $form->get("password")->getData()
        )
      );
      $entityManager = $doctrine->getManager();

      $entityManager->persist($user);
      $entityManager->flush();

      return $this->redirectToRoute("app_admin");
    }

    return $this->render("admin/registerUser.html.twig", [
      "form" => $form->createView()
    ]);
  }

  #[Route("/admin/edit/user/{id}", name: "edit_user")]
  public function edit(Request $request, ManagerRegistry $doctrine, Users $user): Response
  {
    $form = $this->createForm(UsersType::class, $user);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $doctrine->getManager()->flush();
    }

    return $this->render("admin/registerUser.html.twig", [
      "form" => $form->createView()
    ]);
  }

  #[Route("/admin/delete/user/{id}", name: "delete_user")]
  public function delete(ManagerRegistry $doctrine, Users $user): Response
  {
    $entityManager = $doctrine->getManager();
    $entityManager->remove($user);
    $entityManager->flush();

    return $this->redirectToRoute("app_admin");
  }

  #[Route("/admin/disable/user/{id}", name: "disable_user")]
  public function disable(ManagerRegistry $doctrine, Users $user):Response
  {
    $entityManager = $doctrine->getManager();
    $user->setIsActive(false);
    $entityManager->flush($user);

    return $this->redirectToRoute("app_admin");
  }

  #[Route("/admin/enable/user/{id}", name: "enable_user")]
  public function enable(ManagerRegistry $doctrine, Users $user):Response
  {
    $entityManager = $doctrine->getManager();
    $user->setIsActive(true);
    $entityManager->flush($user);

    return $this->redirectToRoute("app_admin");
  }

  #[Route("/admin/user/read-all")]
  public function readAll(ManagerRegistry $doctrine): Response
  {
    $repository = $doctrine->getRepository(Users::class);
    $users = $repository->findAll();
    return $this->render("admin/readAllUsers.html.twig", [
      "users" => $users
    ]);
  }
}