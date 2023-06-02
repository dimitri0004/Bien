<?php

namespace App\Controller;

use App\Entity\BienImmobilier;
use App\Form\BienImmobilierType;
use App\Repository\BienImmobilierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bienImmobilier', name: 'bienImmobilier_')]
class BienImmobilierController extends AbstractController
{
    #[Route('/liste', name: 'liste')]
    public function lister(BienImmobilierRepository $bienImmobilierRepository, Request $request): Response
    {

        $afficher =$bienImmobilierRepository->findAll();
        return $this->render('bien_immobilier/liste.html.twig', [
            'afficher' => $afficher,
        ]);
    }

    #[Route('/ajouter', name: 'ajouter')]
    public function create(Request $request, BienImmobilierRepository $bienImmobilierRepository,EntityManagerInterface $entityManagerInterface): Response
    {
        $BienImmobilier = new BienImmobilier();

        $form =$this->createForm(BienImmobilierType::class, $BienImmobilier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($BienImmobilier);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('bienImmobilier_ajouter');
            $this-> addFlash('success', 'Le Bien Immobilier  a été ajouter avec succes');
        }
        return $this->renderForm('bien_immobilier/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(Request $request, BienImmobilierRepository $bienImmobilierRepository): Response
    {
        $afficher =$bienImmobilierRepository->findAll();
        return $this->render('bien_immobilier/read.html.twig', [
            'afficher' => $afficher,
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function update(Request $request, BienImmobilierRepository $bienImmobilierRepository,EntityManagerInterface $entityManagerInterface, BienImmobilier $BienImmobilier, $id): Response
    {
        $form =$this->createForm(BienImmobilierType::class, $BienImmobilier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($BienImmobilier);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('bienImmobilier_afficher');
            $this-> addFlash('success', 'Le Bien Immobilier  a été modifier avec succes');
        }
        return $this->renderForm('bien_immobilier/update.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function delete(Request $request, BienImmobilierRepository $bienImmobilierRepository, BienImmobilier $BienImmobilier, $id): Response
    {

        $delete=$bienImmobilierRepository->remove($BienImmobilier, true);
        return $this->redirectToRoute('bienImmobilier_afficher');
    }
}
