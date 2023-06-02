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
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;

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
    public function create(SluggerInterface $slugger, Request $request, BienImmobilierRepository $bienImmobilierRepository,EntityManagerInterface $entityManagerInterface): Response
    {
        $BienImmobilier = new BienImmobilier();

        $form =$this->createForm(BienImmobilierType::class, $BienImmobilier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             
            $image = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $BienImmobilier->setImage($newFilename);




            }

            $entityManagerInterface->persist($BienImmobilier);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'Le Bien Immobilier  a été ajouter avec succes');
            return $this->redirectToRoute('bienImmobilier_ajouter');
           
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
    public function update(SluggerInterface $slugger, Request $request, BienImmobilierRepository $bienImmobilierRepository,EntityManagerInterface $entityManagerInterface, BienImmobilier $BienImmobilier, $id): Response
    {
        
        $form =$this->createForm(BienImmobilierType::class, $BienImmobilier);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
        
           

           

            $entityManagerInterface->persist($BienImmobilier);
            $entityManagerInterface->flush();
            $this-> addFlash('success', 'Le Bien Immobilier  a été modifier avec succes');
            return $this->redirectToRoute('bienImmobilier_afficher');
            
        }
        return $this->renderForm('bien_immobilier/update.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function delete(Request $request, BienImmobilierRepository $bienImmobilierRepository, BienImmobilier $BienImmobilier, $id): Response
    {

        $delete=$bienImmobilierRepository->remove($BienImmobilier, true);
        $this-> addFlash('success', 'Le Bien Immobilier  a été supprimer avec succes');
        return $this->redirectToRoute('bienImmobilier_afficher');
        
    }
}
