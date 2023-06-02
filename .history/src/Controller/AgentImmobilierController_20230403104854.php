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

#[Route('/agentImmobilier', name: 'app_agentImmobilier')]
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


            return $this->redirectToRoute('task_success');
        }
        return $this->render('agent_immobilier/index.html.twig', [
            'controller_name' => 'AgentImmobilierController',
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(): Response
    {
        return $this->render('agent_immobilier/index.html.twig', [
            'controller_name' => 'AgentImmobilierController',
        ]);
    }


    #[Route('/modifier', name: 'modifier')]
    public function update(): Response
    {
        return $this->render('agent_immobilier/index.html.twig', [
            'controller_name' => 'AgentImmobilierController',
        ]);
    }

    #[Route('/supprimer', name: 'supprimer')]
    public function delete(): Response
    {
        return $this->render('agent_immobilier/index.html.twig', [
            'controller_name' => 'AgentImmobilierController',
        ]);
    }

   
}
