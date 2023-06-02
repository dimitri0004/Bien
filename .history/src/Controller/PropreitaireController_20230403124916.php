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

#[Route('/propreitaire', name: 'app_propreitaire')]
class PropreitaireController extends AbstractController
{
    #[Route('/propreitaire', name: 'app_propreitaire')]
    public function create(Request $request, PropreitaireRepository $propreitaireRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $propreitaire = new Propreitaire();

        $form =$this->createForm(PropreitaireType::class, $propreitaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($propreitaire);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('agentImmobilier_ajouter');
        }
        return $this->render('propreitaire/create.html.twig', [
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


}
