<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/depense', name: 'app_depense')]
class DepenseController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter')]
    public function create(): Response
    {
        return $this->render('depense/read.html.twig', [
            'controller_name' => 'DepenseController',
        ]);
    }

    #[Route('/afficher', name: 'app_depense')]
    public function read(): Response
    {
        return $this->render('depense/read.html.twig', [
            'controller_name' => 'DepenseController',
        ]);
    }

    #[Route('/modifier', name: 'modifier')]
    public function update(): Response
    {
        return $this->render('depense/index.html.twig', [
            'controller_name' => 'DepenseController',
        ]);
    }

    #[Route('/supprimer', name: 'supprimer')]
    public function delete(): Response
    {
        return $this->render('depense/delete.html.twig', [
            'controller_name' => 'DepenseController',
        ]);
    }
}


