<?php

namespace App\Controller;

use App\Entity\categoriemagasin;
use App\Repository\categoriemagasinRepository;
use App\Form\categoriemagasinType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/categorie/magasin')]
class categoriemagasinController extends AbstractController
{
    #[Route('/', name: 'app_categorie_magasin_index', methods: ['GET'])]
    public function index(categoriemagasinRepository $categoriemagasinRepository): Response
    {
        return $this->render('categorie_magasin/index.html.twig', [
            'categorie_magasins' => $categoriemagasinRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_magasin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoriemagasin = new categoriemagasin();
        $form = $this->createForm(categoriemagasinType::class, $categoriemagasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categoriemagasin);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_magasin/new.html.twig', [
            'categorie_magasin' => $categoriemagasin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_magasin_show', methods: ['GET'])]
    public function show(categoriemagasin $categoriemagasin): Response
    {
        return $this->render('categorie_magasin/show.html.twig', [
            'categorie_magasin' => $categoriemagasin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_magasin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, categoriemagasin $categoriemagasin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(categoriemagasinType::class, $categoriemagasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_magasin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_magasin/edit.html.twig', [
            'categorie_magasin' => $categoriemagasin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_magasin_delete', methods: ['POST'])]
    public function delete(Request $request, categoriemagasin $categoriemagasin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriemagasin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categoriemagasin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_magasin_index', [], Response::HTTP_SEE_OTHER);
    }
}