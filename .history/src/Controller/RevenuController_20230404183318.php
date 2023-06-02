<?php

namespace App\Controller;

use App\Entity\Revenu;
use App\Form\RevenuType;
use App\Repository\RevenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/revenu', name: 'revenu_')]
class RevenuController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter')]
    public function create(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $depense= new Revenu();
        $form =$this->createForm(RevenuType ::class, $depense);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($depense);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'Le Revenu  a été ajouter avec succes');
            return $this->redirectToRoute('revenu_afficher');
            
        
        }

        return $this->render('revenu/create.html.twig', [
            'form' => $form,
        ]);
    }



    #[Route('/afficher', name: 'afficher')]
    public function read(Request $request, RevenuRepository $revenuRepository , EntityManagerInterface $entityManagerInterface): Response
    {
        $afficher =$revenuRepository->findAll();
        return $this->render('revenu/read.html.twig', [
            'Afficher' =>  $afficher,
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function update(Request $request,Revenu $revenu, RevenuRepository $revenuRepository , EntityManagerInterface $entityManagerInterface, $id): Response
    {
        $form =$this->createForm(DepenseType::class, $revenu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($revenu);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'Le Revenu   a été modifier avec succes');
            return $this->redirectToRoute('revenu_afficher');
       
        }
        return $this->renderForm('revenu/update.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function delete(Request $request,Revenu $revenu, RevenuRepository $depenseRepository, $id): Response
    {
        $delete=  $depenseRepository->remove($revenu, true);
        $this-> addFlash('success', 'Le Revenu   a été supprimer  avec succes');
        return $this->redirectToRoute('revenu_afficher');
    }
}
 