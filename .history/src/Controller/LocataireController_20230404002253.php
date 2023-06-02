<?php

namespace App\Controller;

use App\Entity\Locataire;
use App\Form\LocataireType;
use App\Repository\LocataireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/locataire', name: 'locataire_')]
class LocataireController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter')]
    public function create(Request $request, LocataireRepository $locataireRepository, EntityManagerInterface $entityManagerInterface): Response
    {

        $locataire= new Locataire();

        $form =$this->createForm(LocataireType::class, $locataire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($locataire);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'Le Locatairee  a été ajouter avec succes');
            return $this->redirectToRoute('locataire_ajouter');
           
        }
        return $this->renderForm('locataire/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(LocataireRepository $locataireRepository): Response
    {

        $afficher =$locataireRepository->findAll();
        return $this->render('locataire/read.html.twig', [
            'afficher' => $afficher,
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function update(Request $request, LocataireRepository $locataireRepository, EntityManagerInterface $entityManagerInterface,$id,Locataire $locataire): Response
    {
        $form =$this->createForm(LocataireType::class, $locataire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($locataire);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'Le Locatairee  a été ajouter avec succes');
            return $this->redirectToRoute('locataire_ajouter');
           
        }

        return $this->render('locataire/update.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer', name: 'supprimer')]
    public function delete(LocataireRepository $locataireRepository,Locataire $locataire): Response
    {
        $delete= $locataireRepository->remove($locataire, true);
        $this-> addFlash('success', 'Le locataire  a été supprimer avec succes');
        return $this->render('locataire/delete.html.twig');
            
    }

    

}
