<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContratLocationController extends AbstractController
{
    #[Route('/contrat/location', name: 'app_contrat_location')]
    public function index(): Response
    {
        return $this->render('contrat_location/index.html.twig', [
            'controller_name' => 'ContratLocationController',
        ]);
    }
}
