<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{
                                      RedirectResponse,
                                      Request, 
                                      Response
                                    };
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{

    #[Route('/', name: 'login')]
    public function index(): Response
    {
        return $this->render('inicio/index.html');
    }

    #[Route('/autenticar', name: 'autenticar', methods:'POST')]
    public function autenticar(Request $request): RedirectResponse
    {
        $email = $request->request->get('email');
        $senha = $request->request->get('senha');

        // echo "<pre>"; var_dump($email, $senha); echo "</pre>"; exit;

        if($email != '' || $senha != ''){
            return $this->redirectToRoute('home');
        } else {
            $this->addFlash('error', 'Email ou Senha inválidos.');

            return $this->redirectToRoute('login');
        }
    }

    #[Route('/inscrever_se', name: 'inscrever_se')]
    public function inscreverSe(): Response
    {
        return $this->render('inicio/inscreverse.html.twig');
    }
}