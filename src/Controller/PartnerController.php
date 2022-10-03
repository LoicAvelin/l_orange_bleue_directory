<?php

namespace App\Controller;

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
    public function partnerInformations(): Response
    {
        return $this->render("partner/partnerInformations.html.twig");
    }

    #[Route("/partner/permissions", name: "app_partner_permissions")]
    public function partnerPermissions(): Response
    {
        return $this->render("partner/partnerPermissions.html.twig");
    }

    #[Route("/partner/structures", name: "app_partner_structures")]
    public function partnerStructures(): Response
    {
        return $this->render("partner/partnerStructures.html.twig");
    }
}
