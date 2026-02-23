<?php

namespace App\Controller;

use App\Entity\Categorieactivite;
use App\Form\CategorieactiviteType;
use App\Repository\CategorieactiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorieactivite')]
class CategorieactiviteController extends AbstractController
{
    #[Route('/', name: 'app_categorieactivite_index', methods: ['GET'])]
    public function index(CategorieactiviteRepository $categorieactiviteRepository): Response
    {
        return $this->render('categorieactivite/index.html.twig', [
            'categorieactivites' => $categorieactiviteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorieactivite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieactivite = new Categorieactivite();
        $form = $this->createForm(CategorieactiviteType::class, $categorieactivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieactivite);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorieactivite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorieactivite/new.html.twig', [
            'categorieactivite' => $categorieactivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorieactivite_show', methods: ['GET'])]
    public function show(Categorieactivite $categorieactivite): Response
    {
        return $this->render('categorieactivite/show.html.twig', [
            'categorieactivite' => $categorieactivite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorieactivite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorieactivite $categorieactivite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieactiviteType::class, $categorieactivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorieactivite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorieactivite/edit.html.twig', [
            'categorieactivite' => $categorieactivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorieactivite_delete', methods: ['POST'])]
    public function delete(Request $request, Categorieactivite $categorieactivite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieactivite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorieactivite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorieactivite_index', [], Response::HTTP_SEE_OTHER);
    }
}
