<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienImmobilierController extends AbstractController
{
    #[Route('/bien/immobilier', name: 'app_bien_immobilier')]
    public function index(): Response
    {
        return $this->render('bien_immobilier/index.html.twig', [
            'controller_name' => 'BienImmobilierController',
        ]);
    }
}
