<?php

namespace App\Controller;

use App\Entity\Structures;
use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnerController extends AbstractController
{
    #[Route("/partner", name: "app_partner")]
    public function partnerHome(): Response
    {
        return $this->render("partner/partnerHome.html.twig");
    }

    #[Route("/partner/info", name: "app_partner_info")]
    public function partnerInformations(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Users::class);
        $id = $this->getUser()->getId();
        $user = $repository->find($id);
        return $this->render("partner/partnerInformations.html.twig", [
            "user" => $user
        ]);
    }

    #[Route("/partner/permissions", name: "app_partner_permissions")]
    public function partnerPermissions(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Users::class);
        $id = $this->getUser()->getId();
        $user = $repository->find($id);
        $permissions = $user->getPermissions();
        return $this->render("partner/partnerPermissions.html.twig", [
            "permissions" => $permissions
        ]);
    }
    // TODO: update the entity Partner_permission with a row is_active for manage the disable/enable for each partner
    #[Route("/partner/disable/permission", name: "disable_permission_partner")]
    public function disable(ManagerRegistry $doctrine, Permissions $permission):Response
    {
        $entityManager = $doctrine->getManager();
        $permission->setIsActive(false);
        $entityManager->flush($permission);

        return $this->redirectToRoute("app_partner_permissions");
    }

    #[Route("/partner/enable/permission", name: "enable_permission_partner")]
    public function enable(ManagerRegistry $doctrine, Permissions $permission):Response
    {
        $entityManager = $doctrine->getManager();
        $permission->setIsActive(true);
        $entityManager->flush($permission);

        return $this->redirectToRoute("app_partner_permissions");
    }
    // TODO: add permissions for each structures
    #[Route("/partner/structures", name: "app_partner_structures")]
    public function partnerStructures(ManagerRegistry $doctrine): Response
    {  
        $repository = $doctrine->getRepository(Users::class);
        $id = $this->getUser()->getId();
        $user = $repository->find($id);
        $structures = $user->getStructures();
        $repositoryStructures = $doctrine->getRepository(Structures::class);
        $idStructures = $this->getUser();
        $permissions = $repositoryStructures->find($idStructures);
        return $this->render("partner/partnerStructures.html.twig", [
            "structures" => $structures,
            "permissions" => $permissions
        ]);
    }
}
