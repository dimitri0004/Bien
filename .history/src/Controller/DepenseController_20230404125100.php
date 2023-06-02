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


#[Route('/depense', name: 'depense_')]
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
            
        
        }
        return $this->renderForm('depense/read.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(Request $request, DepenseRepository $depenseRepository , EntityManagerInterface $entityManagerInterface): Response
    {
        $afficher =$depenseRepository->findAll();
        return $this->render('depense/read.html.twig', [
            'Afficher' => $afficher,
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function update(Request $request,Depense $depense, DepenseRepository $depenseRepository , EntityManagerInterface $entityManagerInterface, $id): Response
    {
        $form =$this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($depense);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'La depense   a été ajouter avec succes');
            return $this->redirectToRoute('depense_afficher');
        return $this->renderForm('depense/index.html.twig', [
            'form' => $form,
        ]);
        }
    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function delete($request,Depense $depense, DepenseRepository $depenseRepository, $id): Response
    {
        $delete=  $depenseRepository->remove($depense, true);
        return $this->redirectToRoute('depense_afficher');
    }
}


