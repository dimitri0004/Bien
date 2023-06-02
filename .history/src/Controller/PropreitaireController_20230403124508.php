<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/propreitaire', name: 'app_propreitaire')]
class PropreitaireController extends AbstractController
{
    #[Route('/propreitaire', name: 'app_propreitaire')]
    public function create(): Response
    {
        return $this->render('propreitaire/index.html.twig', [
            'controller_name' => 'PropreitaireController',
        ]);
    }

    public function read(): Response
    {
        return $this->render('propreitaire/index.html.twig', [
            'controller_name' => 'PropreitaireController',
        ]);
    }

    public function update(): Response
    {
        return $this->render('propreitaire/index.html.twig', [
            'controller_name' => 'PropreitaireController',
        ]);
    }

    public function delete(): Response
    {
        return $this->render('propreitaire/index.html.twig', [
            'controller_name' => 'PropreitaireController',
        ]);
    }

    public function index(): Response
    {
        return $this->render('propreitaire/index.html.twig', [
            'controller_name' => 'PropreitaireController',
        ]);
    }

    public function index(): Response
    {
        return $this->render('propreitaire/index.html.twig', [
            'controller_name' => 'PropreitaireController',
        ]);
    }


}
