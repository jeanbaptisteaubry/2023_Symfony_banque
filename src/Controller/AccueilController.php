<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'controlleur_accueil')]
    public function controlleur_accueil(): Response
    {
        return $this->render('accueil/index.html.twig');
    }

    #[Route('/nos_offres', name: 'controlleur_offres')]
    public function controlleur_offres(): Response
    {
        return $this->render('accueil/offres.html.twig');
    }

    #[Route('/nos_clients', name: 'controlleur_clients')]
    public function controlleur_clients(): Response
    {
        return $this->render('accueil/client.html.twig');
    }
}
