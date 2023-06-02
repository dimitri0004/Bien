<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropreitaireController extends AbstractController
{
    #[Route('/propreitaire', name: 'app_propreitaire')]
    public function index(): Response
    {
        return $this->render('propreitaire/index.html.twig', [
            'controller_name' => 'PropreitaireController',
        ]);
    }
}
