<?php

namespace App\Controller;

use App\Entity\VirementSortant;
use App\Form\VirementSortant1Type;
use App\Repository\VirementSortantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/virement/sortant')]
class VirementSortantController extends AbstractController
{
    #[Route('/', name: 'app_virement_sortant_index', methods: ['GET'])]
    public function index(VirementSortantRepository $virementSortantRepository): Response
    {
        return $this->render('virement_sortant/index.html.twig', [
            'virement_sortants' => $virementSortantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_virement_sortant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VirementSortantRepository $virementSortantRepository): Response
    {
        $virementSortant = new VirementSortant();
        $form = $this->createForm(VirementSortant1Type::class, $virementSortant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $virementSortantRepository->save($virementSortant, true);

            return $this->redirectToRoute('app_virement_sortant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('virement_sortant/new.html.twig', [
            'virement_sortant' => $virementSortant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_virement_sortant_show', methods: ['GET'])]
    public function show(VirementSortant $virementSortant): Response
    {
        return $this->render('virement_sortant/show.html.twig', [
            'virement_sortant' => $virementSortant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_virement_sortant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VirementSortant $virementSortant, VirementSortantRepository $virementSortantRepository): Response
    {
        $form = $this->createForm(VirementSortant1Type::class, $virementSortant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $virementSortantRepository->save($virementSortant, true);

            return $this->redirectToRoute('app_virement_sortant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('virement_sortant/edit.html.twig', [
            'virement_sortant' => $virementSortant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_virement_sortant_delete', methods: ['POST'])]
    public function delete(Request $request, VirementSortant $virementSortant, VirementSortantRepository $virementSortantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$virementSortant->getId(), $request->request->get('_token'))) {
            $virementSortantRepository->remove($virementSortant, true);
        }

        return $this->redirectToRoute('app_virement_sortant_index', [], Response::HTTP_SEE_OTHER);
    }
}
