<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{

    #[Route('/', name: 'login')]
    public function index(): Response
    {
        return $this->render('inicio/index.html.twig');
    }

    #[Route('/inscrever_se', name: 'inscrever_se')]
    public function inscreverSe(): Response
    {
        return $this->render('inicio/inscreverse.html.twig');
    }
}