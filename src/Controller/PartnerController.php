<?php

namespace App\Controller;

use App\Repository\PermissionsStructuresRepository;
use App\Repository\PermissionsUsersRepository;
use App\Repository\StructuresRepository;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnerController extends AbstractController
{
    #[Route("/partner", name: "app_partner")]
    public function partnerHome(UsersRepository $repository): Response
    {
        $id = $this->getUser()->getId();
        $user = $repository->find($id);
        return $this->render("partner/partnerHome.html.twig", [
            "user" => $user
        ]);
    }

    #[Route("/partner/disable/permission/{idPermission}", name: "disable_permission_partner")]
    public function disablePermission(ManagerRegistry $doctrine, PermissionsUsersRepository $repo, int $idPermission):Response
    {
        $entityManager = $doctrine->getManager();
        $id = $this->getUser()->getId();
        $permissionUser = $repo->findOneBy(array("Permissions" => $idPermission, "users" => $id))->setIsActive(false);
        $entityManager->flush($permissionUser);

        return $this->redirectToRoute("app_partner");
    }

    #[Route("/partner/enable/permission/{idPermission}", name: "enable_permission_partner")]
    public function enablePermission(ManagerRegistry $doctrine, PermissionsUsersRepository $repo, int $idPermission):Response
    {
        $entityManager = $doctrine->getManager();
        $id = $this->getUser()->getId();
        $permissionUser = $repo->findOneBy(array("Permissions" => $idPermission, "users" => $id))->setIsActive(true);
        $entityManager->flush($permissionUser);

        return $this->redirectToRoute("app_partner");
    }

    #[Route("/partner/disable/structure/{idStructure}", name: "disable_structure_partner")]
    public function disableStructure(ManagerRegistry $doctrine, StructuresRepository $repo, int $idStructure):Response
    {
        $entityManager = $doctrine->getManager();
        $structure = $repo->find($idStructure)->setIsActive(false);
        $entityManager->flush($structure);

        return $this->redirectToRoute("app_partner");
    }

    #[Route("/partner/enable/structure/{idStructure}", name: "enable_structure_partner")]
    public function enableStructure(ManagerRegistry $doctrine, StructuresRepository $repo, int $idStructure):Response
    {
        $entityManager = $doctrine->getManager();
        $structure = $repo->find($idStructure)->setIsActive(true);
        $entityManager->flush($structure);

        return $this->redirectToRoute("app_partner");
    }

    #[Route("/partner/disable/permission/structure/{idPermission}{idStructure}", name: "disable_permission_structure_partner")]
    public function disablePermissionStructure(ManagerRegistry $doctrine, PermissionsStructuresRepository $repo, int $idPermission, int $idStructure):Response
    {
        $entityManager = $doctrine->getManager();
        $permissionStructure = $repo->findOneBy(array("permissions" => $idPermission, "structures" => $idStructure))->setIsActive(false);
        $entityManager->flush($permissionStructure);

        return $this->redirectToRoute("app_partner");
    }

    #[Route("/partner/enable/permission/structure/{idPermission}{idStructure}", name: "enable_permission_structure_partner")]
    public function enablePermissionStructure(ManagerRegistry $doctrine, PermissionsStructuresRepository $repo, int $idPermission, int $idStructure):Response
    {
        $entityManager = $doctrine->getManager();
        $permissionStructure = $repo->findOneBy(array("permissions" => $idPermission, "structures" => $idStructure))->setIsActive(true);
        $entityManager->flush($permissionStructure);

        return $this->redirectToRoute("app_partner");
    }
}
