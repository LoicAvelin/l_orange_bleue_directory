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

  #[Route("/admin/edit/structure/{id}", name: "edit_structure")]
  public function edit(Request $request, ManagerRegistry $doctrine, Structures $structure): Response
  {
    $form = $this->createForm(StructuresType::class, $structure);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $doctrine->getManager()->flush();
    }

    return $this->render("admin/editStructure.html.twig", [
      "form" => $form->createView()
    ]);
  }

  #[Route("/admin/delete/structure/{id}", name: "delete_structure")]
  public function delete(ManagerRegistry $doctrine, Structures $structure): Response
  {
    $entityManager = $doctrine->getManager();
    $entityManager->remove($structure);
    $entityManager->flush();

    return $this->redirectToRoute("app_admin");
  }

  #[Route("/admin/disable/structure/{id}", name: "disable_structure")]
  public function disable(ManagerRegistry $doctrine, Structures $structure):Response
  {
    $entityManager = $doctrine->getManager();
    $structure->setIsActive(false);
    $entityManager->flush($structure);

    return $this->redirectToRoute("app_admin");
  }

  #[Route("/admin/enable/structure/{id}", name: "enable_structure")]
  public function enable(ManagerRegistry $doctrine, Structures $structure):Response
  {
    $entityManager = $doctrine->getManager();
    $structure->setIsActive(true);
    $entityManager->flush($structure);

    return $this->redirectToRoute("app_admin");
  }

  #[Route("/admin/structure/read-all")]
  public function readAll(ManagerRegistry $doctrine): Response
  {
    $repository = $doctrine->getRepository(Structures::class);
    $structures = $repository->findAll();
    return $this->render("admin/readAllStructures.html.twig", [
      "structures" => $structures
    ]);
  }
}