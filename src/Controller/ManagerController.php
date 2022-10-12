<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\PermissionsStructuresRepository;
use App\Repository\PermissionsUsersRepository;
use App\Repository\StructuresRepository;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends AbstractController
{
    #[Route("/manager", name: "app_manager")]
    public function managerHome(UsersRepository $repository): Response
    {
        $id = $this->getUser()->getId();
        $user = $repository->find($id);
        return $this->render("manager/managerHome.html.twig", [
            "user" => $user
        ]);
    }

    #[Route("/manager/disable/permission/{idPermission}", name: "disable_permission_manager")]
    public function disablePermission(ManagerRegistry $doctrine, PermissionsUsersRepository $repo, int $idPermission):Response
    {
        $entityManager = $doctrine->getManager();
        $id = $this->getUser()->getId();
        $permissionUser = $repo->findOneBy(array("Permissions" => $idPermission, "users" => $id))->setIsActive(false);
        $entityManager->flush($permissionUser);

        return $this->redirectToRoute("app_manager");
    }

    #[Route("/manager/enable/permission/{idPermission}", name: "enable_permission_manager")]
    public function enablePermission(ManagerRegistry $doctrine, PermissionsUsersRepository $repo, int $idPermission):Response
    {
        $entityManager = $doctrine->getManager();
        $id = $this->getUser()->getId();
        $permissionUser = $repo->findOneBy(array("Permissions" => $idPermission, "users" => $id))->setIsActive(true);
        $entityManager->flush($permissionUser);

        return $this->redirectToRoute("app_manager");
    }

    #[Route("/manager/disable/structure/{idStructure}", name: "disable_structure_manager")]
    public function disableStructure(ManagerRegistry $doctrine, StructuresRepository $repo, int $idStructure):Response
    {
        $entityManager = $doctrine->getManager();
        $structure = $repo->find($idStructure)->setIsActive(false);
        $entityManager->flush($structure);

        return $this->redirectToRoute("app_manager");
    }

    #[Route("/manager/enable/structure/{idStructure}", name: "enable_structure_manager")]
    public function enableStructure(ManagerRegistry $doctrine, StructuresRepository $repo, int $idStructure):Response
    {
        $entityManager = $doctrine->getManager();
        $structure = $repo->find($idStructure)->setIsActive(true);
        $entityManager->flush($structure);

        return $this->redirectToRoute("app_manager");
    }

    #[Route("/manager/disable/permission/structure/{idPermission}{idStructure}", name: "disable_permission_structure_manager")]
    public function disablePermissionStructure(ManagerRegistry $doctrine, PermissionsStructuresRepository $repo, int $idPermission, int $idStructure):Response
    {
        $entityManager = $doctrine->getManager();
        $permissionStructure = $repo->findOneBy(array("permissions" => $idPermission, "structures" => $idStructure))->setIsActive(false);
        $entityManager->flush($permissionStructure);

        return $this->redirectToRoute("app_manager");
    }

    #[Route("/manager/enable/permission/structure/{idPermission}{idStructure}", name: "enable_permission_structure_manager")]
    public function enablePermissionStructure(ManagerRegistry $doctrine, PermissionsStructuresRepository $repo, int $idPermission, int $idStructure):Response
    {
        $entityManager = $doctrine->getManager();
        $permissionStructure = $repo->findOneBy(array("permissions" => $idPermission, "structures" => $idStructure))->setIsActive(true);
        $entityManager->flush($permissionStructure);

        return $this->redirectToRoute("app_manager");
    }
}
