<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends AbstractController
{
    #[Route("/manager", name: "app_manager")]
    public function managerHome(): Response
    {
        return $this->render("manager/managerHome.html.twig");
    }

    #[Route("/manager/info", name: "app_manager_info")]
    public function managerInformations(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Users::class);
        $id = $this->getUser()->getId();
        $user = $repository->find($id);
        return $this->render("manager/managerInformations.html.twig", [
            "user" => $user
        ]);
    }

    #[Route("/manager/permissions", name: "app_manager_permissions")]
    public function managerPermissions(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Users::class);
        $id = $this->getUser()->getId();
        $user = $repository->find($id);
        $permissions = $user->getPermissions();
        return $this->render("manager/managerPermissions.html.twig", [
            "permissions" => $permissions
        ]);
    }
    // TODO: update the entity Partner_permission with a row is_active for manage the disable/enable for each partner
    #[Route("/manager/disable/permission", name: "disable_permission_manager")]
    public function disable(ManagerRegistry $doctrine, Permissions $permission):Response
    {
        $entityManager = $doctrine->getManager();
        $permission->setIsActive(false);
        $entityManager->flush($permission);

        return $this->redirectToRoute("app_manager_permissions");
    }

    #[Route("/manager/enable/permission", name: "enable_permission_manager")]
    public function enable(ManagerRegistry $doctrine, Permissions $permission):Response
    {
        $entityManager = $doctrine->getManager();
        $permission->setIsActive(true);
        $entityManager->flush($permission);

        return $this->redirectToRoute("app_manager_permissions");
    }

    #[Route("/manager/structure", name: "app_manager_structures")]
    public function managerStructure(ManagerRegistry $doctrine): Response
    {  
        $repository = $doctrine->getRepository(Users::class);
        $id = $this->getUser()->getId();
        $user = $repository->find($id);
        $structure = $user->getStructures();
        return $this->render("manager/managerStructure.html.twig", [
            "structure" => $structure,
        ]);
    }
}
