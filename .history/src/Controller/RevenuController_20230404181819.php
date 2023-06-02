<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RevenuController extends AbstractController
{
    #[Route('/revenu', name: 'app_revenu')]
    public function index(): Response
    {
        return $this->render('revenu/index.html.twig', [
            'controller_name' => 'RevenuController',
        ]);
    }
}
 