<?php

namespace App\Controller;

use App\Entity\ContratLocation;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ContratLocationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ContratLocation', name: 'contratLocation_')]
class ContratLocationController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter')]
    public function create(Request $request, ContratLocationRepository $ContratLocationRepository , EntityManagerInterface $entityManagerInterface): Response
    {
        $ContratLocation= new ContratLocation();
        $form =$this->createForm(ContratLocationType::class, $ContratLocation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($ContratLocation);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'La ContratLocation   a été ajouter avec succes');
            return $this->redirectToRoute('contratLocation_afficher');
            
        
        }
        return $this->renderForm('ContratLocation/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(Request $request, ContratLocationRepository $ContratLocationRepository , EntityManagerInterface $entityManagerInterface): Response
    {
        $afficher =$ContratLocationRepository->findAll();
        return $this->render('ContratLocation/read.html.twig', [
            'Afficher' =>  $afficher,
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function update(Request $request,ContratLocation $ContratLocation, ContratLocationRepository $ContratLocationRepository , EntityManagerInterface $entityManagerInterface, $id): Response
    {
        $form =$this->createForm(ContratLocationType::class, $ContratLocation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($ContratLocation);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'La ContratLocation   a été modifier avec succes');
            return $this->redirectToRoute('contratLocation_afficher');
       
        }
        return $this->renderForm('ContratLocation/update.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function delete(Request $request,ContratLocation $ContratLocation, ContratLocationRepository $ContratLocationRepository, $id): Response
    {
        $delete=  $ContratLocationRepository->remove($ContratLocation, true);
        return $this->redirectToRoute('contratLocation_afficher');
    }
}
