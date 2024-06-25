<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use OpenApi\Attributes as OA;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login', methods:['GET'])]
    #[OA\Get(
        path: '/login',
        tags: ['Security'],
        summary: 'Afficher la page de connexion',
        description: 'Retourne la page de connexion pour les utilisateurs.',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Page de connexion affichée'
            ),
            new OA\Response(
                response: 302,
                description: 'Redirection si l\'utilisateur est déjà connecté'
            )
        ]
    )]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout', methods:['POST'])]
    #[OA\Post(
        path: '/logout',
        tags: ['Security'],
        summary: 'Déconnexion de l\'utilisateur',
        description: 'Déconnecte l\'utilisateur actuel.',
        responses: [
            new OA\Response(
                response: 204,
                description: 'Utilisateur déconnecté'
            )
        ]
    )]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
