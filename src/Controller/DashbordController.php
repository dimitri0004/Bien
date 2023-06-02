<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashbordController extends AbstractController
{
    #[Route('/', name: 'dashbord')]
    public function index(): Response
    {
        return $this->render('dashbord/index.html.twig');
    }
}
