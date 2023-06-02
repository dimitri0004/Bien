<?php

namespace App\Controller;

use App\Entity\Revenu;
use App\Form\RevenuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/revenu', name: 'revenu')]
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

        return $this->render('revenu/index.html.twig', [
            'controller_name' => 'RevenuController',
        ]);
    }
}
 