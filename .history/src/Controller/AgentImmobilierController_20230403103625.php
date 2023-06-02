<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentImmobilierController extends AbstractController
{
    #[Route('/agent/immobilier', name: 'app_agent_immobilier')]
    public function index(): Response
    {
        return $this->render('agent_immobilier/index.html.twig', [
            'controller_name' => 'AgentImmobilierController',
        ]);
    }
}
