<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
  #[Route("/admin/register/user", name: "admin_home")]
  public function new(
    Request $request, 
    UserPasswordHasherInterface $userPasswordHasher, 
    ManagerRegistry $doctrine,
    MailerInterface $mailer
  ): Response
  {
    $user = new Users();
    $form = $this->createForm(UsersType::class, $user);
    $data = $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // send a email to the new user
      $email = (new TemplatedEmail())
        ->from("admin@lorangebleue.com")
        ->to($data->get("email")->getData())
        ->subject("Bienvenue à l'orange bleue !")
        ->htmlTemplate("emails/signup.html.twig")
        ->context([
          "name" => $data->get("name")->getData(),
          "mail" => $data->get("email")->getData(),
          "role" => $data->get("roles")->getData(),
          "structures" => $data->get("structures")->getData()
        ]);
      $mailer->send($email);
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

    
    return $this->render("admin/users/registerUser.html.twig", [
      "form" => $form->createView()
    ]);
  }

  #[Route("/admin/edit/user/{id}", name: "edit_user")]
  public function edit(
    Request $request, 
    UserPasswordHasherInterface $userPasswordHasher,
    ManagerRegistry $doctrine, 
    Users $user,
    MailerInterface $mailer
  ): Response
  {
    $form = $this->createForm(UsersType::class, $user);

    $data = $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      // send email to the modify user 
      $email = (new TemplatedEmail())
      ->from("admin@lorangebleue.com")
      ->to($data->get("email")->getData())
      ->subject("Modification sur votre compte")
      ->htmlTemplate("emails/update.html.twig")
      ->context([
        "name" => $data->get("name")->getData(),
        "mail" => $data->get("email")->getData(),
        "role" => $data->get("roles")->getData(),
        "structures" => $data->get("structures")->getData()
      ]);
    $mailer->send($email);

      $user->setPassword(
        $userPasswordHasher->hashPassword(
          $user, 
          $form->get("password")->getData()
        )
      );
      $entityManager = $doctrine->getManager();
      $entityManager->flush();
    }

    return $this->render("admin/users/editUser.html.twig", [
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

    return $this->redirectToRoute("read_all_user");
  }

  #[Route("/admin/enable/user/{id}", name: "enable_user")]
  public function enable(ManagerRegistry $doctrine, Users $user):Response
  {
    $entityManager = $doctrine->getManager();
    $user->setIsActive(true);
    $entityManager->flush($user);

    return $this->redirectToRoute("read_all_user");
  }

  #[Route("/admin/user/read-all", name: "read_all_user")]
  public function readAll(ManagerRegistry $doctrine): Response
  {
    $repository = $doctrine->getRepository(Users::class);
    $users = $repository->findAll();
    return $this->render("admin//users/readAllUsers.html.twig", [
      "users" => $users
    ]);
  }
}