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

#[Route('/bienImmobilier', name: 'bienImmobilier')]
class BienImmobilierController extends AbstractController
{
    #[Route('/liste', name: 'liste')]
    public function lister(): Response
    {
        return $this->render('bien_immobilier/index.html.twig', [
            'controller_name' => 'BienImmobilierController',
        ]);
    }

    #[Route('/ajouter', name: 'ajouter')]
    public function create(Request $request, BienImmobilierRepository $bienImmobilierRepository,EntityManagerInterface $entityManagerInterface): Response
    {
        $propreitaire = new BienImmobilier();

        $form =$this->createForm(BienImmobilierType::class, $propreitaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($propreitaire);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('bienImmobilier_ajouter');
        }
        return $this->render('bien_immobilier/create.html.twig', [
            'controller_name' => 'BienImmobilierController',
        ]);
    }

    #[Route('/afficher', name: 'afficher')]
    public function read(): Response
    {
        return $this->render('bien_immobilier/afficher.html.twig', [
            'controller_name' => 'BienImmobilierController',
        ]);
    }

    #[Route('/update', name: 'update')]
    public function update(): Response
    {
        return $this->render('bien_immobilier/update.html.twig', [
            'controller_name' => 'BienImmobilierController',
        ]);
    }

    #[Route('/supprimer', name: 'supprimer')]
    public function delete(): Response
    {
        return $this->render('bien_immobilier/delete.html.twig', [
            'controller_name' => 'BienImmobilierController',
        ]);
    }
}
