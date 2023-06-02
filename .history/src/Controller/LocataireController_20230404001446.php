<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/locataire', name: 'locataire_')]
class LocataireController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter')]
    public function create(): Response
    {
        return $this->render('locataire/create.html.twig', [
            'controller_name' => 'LocataireController',
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(): Response
    {
        return $this->render('locataire/read.html.twig', [
            'controller_name' => 'LocataireController',
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function update(): Response
    {
        return $this->render('locataire/update.html.twig', [
            'controller_name' => 'LocataireController',
        ]);
    }

    #[Route('/supprimer', name: 'supprimer')]
    public function delete(): Response
    {
        return $this->render('locataire/delete.html.twig', [
            'controller_name' => 'LocataireController',
        ]);
    }

    

}
