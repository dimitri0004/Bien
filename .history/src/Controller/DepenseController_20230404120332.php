<?php

namespace App\Controller;

use App\Entity\Depense;
use App\Form\DepenseType;
use App\Repository\DepenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/depense', name: 'app_depense')]
class DepenseController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter')]
    public function create(Request $request, DepenseRepository $depenseRepository , EntityManagerInterface $entityManagerInterface): Response
    {
        $depense= new Depense();
        $form =$this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($depense);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'La depense   a été ajouter avec succes');
            return $this->redirectToRoute('depense_afficher');
            
        return $this->render('depense/read.html.twig', [
            'form' => $form,
        ]);
        }
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


