<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contrat', name: 'contrat')]
class ContratLocationController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter')]
    public function create(Request $request, FactureRepository $factureRepository , EntityManagerInterface $entityManagerInterface): Response
    {
        $facture= new Facture();
        $form =$this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($facture);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'La Facture   a été ajouter avec succes');
            return $this->redirectToRoute('facture_afficher');
            
        
        }
        return $this->renderForm('Facture/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(Request $request, FactureRepository $factureRepository , EntityManagerInterface $entityManagerInterface): Response
    {
        $afficher =$factureRepository->findAll();
        return $this->render('Facture/read.html.twig', [
            'Afficher' =>  $afficher,
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function update(Request $request,Facture $facture, FactureRepository $factureRepository , EntityManagerInterface $entityManagerInterface, $id): Response
    {
        $form =$this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($facture);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'La Facture   a été modifier avec succes');
            return $this->redirectToRoute('facture_afficher');
       
        }
        return $this->renderForm('Facture/update.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function delete(Request $request,Facture $facture, FactureRepository $factureRepository, $id): Response
    {
        $delete=  $factureRepository->remove($facture, true);
        return $this->redirectToRoute('facture_afficher');
    }
}
