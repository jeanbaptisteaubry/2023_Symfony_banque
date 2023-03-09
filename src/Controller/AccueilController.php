<?php

namespace App\Controller;

use App\Repository\TypeClientRepository;
use App\Repository\TypeOffreRepository;
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
    public function controlleur_offres(TypeOffreRepository $typeOffreRepository): Response
    {

        return $this->render('accueil/offres.html.twig', [
            'listeTypeOffre' => $typeOffreRepository->findAll(),
        ]   );
    }

    #[Route('/nos_clients', name: 'controlleur_clients')]
    public function controlleur_clients(TypeClientRepository $typeClientRepository): Response
    {
        return $this->render('accueil/client.html.twig'
            , [
                'listeTypeClient' => $typeClientRepository->findAll(),
            ]
        );
    }
}
