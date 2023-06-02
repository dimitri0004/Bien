<?php

namespace App\Controller;

use App\Entity\Propreitaire;
use App\Form\PropreitaireType;
use App\Repository\PropreitaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/propreitaire', name: 'propreitaire_')]
class PropreitaireController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter')]
    public function create(Request $request, PropreitaireRepository $propreitaireRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $propreitaire = new Propreitaire();

        $form =$this->createForm(PropreitaireType::class, $propreitaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($propreitaire);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('propreitaire_ajouter');
        }
        return $this->render('propreitaire/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/propreitaire', name: 'afficher')]
    public function read(Request $request,PropreitaireRepository $propreitaireRepository): Response
    {
        $afficher =$propreitaireRepository->findAll();
        return $this->render('propreitaire/read.html.twig', [
            'afficher' => $afficher,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_propreitaire')]
    public function update(Request $request, PropreitaireRepository $propreitaireRepository, EntityManagerInterface $entityManagerInterface, Propreitaire $propreitaire, $id): Response
    {
        $form =$this->createForm(PropreitaireType::class, $propreitaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($propreitaire);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('modifier');
        }
        return $this->render('propreitaire/modifier.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function delete(Request $request, PropreitaireRepository $propreitaireRepository,Propreitaire $propreitaire, $id): Response
    {
        $delete= $propreitaireRepository->remove($propreitaire, true);
        return $this->redirectToRoute('propreitaire_afficher');
    }


}
