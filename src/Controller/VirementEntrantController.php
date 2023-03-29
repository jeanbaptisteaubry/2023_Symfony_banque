<?php

namespace App\Controller;

use App\Entity\VirementEntrant;
use App\Form\VirementEntrant1Type;
use App\Repository\VirementEntrantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/virement/entrant')]
class VirementEntrantController extends AbstractController
{
    #[Route('/', name: 'app_virement_entrant_index', methods: ['GET'])]
    public function index(VirementEntrantRepository $virementEntrantRepository): Response
    {
        return $this->render('virement_entrant/index.html.twig', [
            'virement_entrants' => $virementEntrantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_virement_entrant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VirementEntrantRepository $virementEntrantRepository): Response
    {
        $virementEntrant = new VirementEntrant();
        $form = $this->createForm(VirementEntrant1Type::class, $virementEntrant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $virementEntrantRepository->save($virementEntrant, true);

            return $this->redirectToRoute('app_virement_entrant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('virement_entrant/new.html.twig', [
            'virement_entrant' => $virementEntrant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_virement_entrant_show', methods: ['GET'])]
    public function show(VirementEntrant $virementEntrant): Response
    {
        return $this->render('virement_entrant/show.html.twig', [
            'virement_entrant' => $virementEntrant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_virement_entrant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VirementEntrant $virementEntrant, VirementEntrantRepository $virementEntrantRepository): Response
    {
        $form = $this->createForm(VirementEntrant1Type::class, $virementEntrant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $virementEntrantRepository->save($virementEntrant, true);

            return $this->redirectToRoute('app_virement_entrant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('virement_entrant/edit.html.twig', [
            'virement_entrant' => $virementEntrant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_virement_entrant_delete', methods: ['POST'])]
    public function delete(Request $request, VirementEntrant $virementEntrant, VirementEntrantRepository $virementEntrantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$virementEntrant->getId(), $request->request->get('_token'))) {
            $virementEntrantRepository->remove($virementEntrant, true);
        }

        return $this->redirectToRoute('app_virement_entrant_index', [], Response::HTTP_SEE_OTHER);
    }
}
