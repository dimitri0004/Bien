<?php

namespace App\Controller;

use App\Entity\AgentImmobilier;
use App\Form\AgentImmobilierType;
use App\Repository\AgentImmobilierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agentImmobilier', name: 'agentImmobilier_')]
class AgentImmobilierController extends AbstractController
{
    #[Route('/lste', name: 'liste')]
    public function Liste(): Response
    {
        return $this->render('agent_immobilier/index.html.twig', [
            'controller_name' => 'AgentImmobilierController',
        ]);
    }

    #[Route('ajouter', name: 'ajouter')]
    public function create(Request $request , AgentImmobilierRepository $agentImmobilierRepository,EntityManagerInterface $entityManagerInterface): Response
    {
        $agentImmobilier = new AgentImmobilier();

        $form =$agentImmobilierRepository->createForm(AgentImmobilierType::class, $agentImmobilier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($agentImmobilier);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('agentImmobilier_ajouter');
        }
        return $this->renderForm('agent_immobilier/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(AgentImmobilierRepository $agentImmobilierRepository): Response
    {
        $afficher =$agentImmobilierRepository->findAll();
        return $this->render('agent_immobilier/.html.twig', [
            'cafficher' => $afficher
        ]);
    }


    #[Route('/modifier/{id}', name: 'modifier')]
    public function update(Request $request , AgentImmobilierRepository $agentImmobilierRepository,EntityManagerInterface $entityManagerInterface, AgentImmobilier $agentImmobilier): Response
    {
       

        $form =$agentImmobilierRepository->createForm(AgentImmobilierType::class, $agentImmobilier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($agentImmobilier);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('agentImmobilier_ajouter');
        }
        return $this->renderForm('agent_immobilier/update.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function delete(AgentImmobilier $agentImmobilier, AgentImmobilierRepository $agentImmobilierRepository, $id): Response
    {
        $delete= $agentImmobilierRepository->remove($agentImmobilier, true);
        return $this->render('agent_immobilier/index.html.twig', [
            'controller_name' => 'AgentImmobilierController',
        ]);
    }

   
}
