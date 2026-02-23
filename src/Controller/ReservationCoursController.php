<?php

namespace App\Controller;

use App\Entity\ReservationCours;
use App\Form\ReservationCoursType;
use App\Repository\ReservationCoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation/cours')]
class ReservationCoursController extends AbstractController
{
    #[Route('/', name: 'app_reservation_cours_index', methods: ['GET'])]
    public function index(ReservationCoursRepository $reservationCoursRepository): Response
    {
        return $this->render('reservation_cours/index.html.twig', [
            'reservation_cours' => $reservationCoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationCour = new ReservationCours();

        // Set the current date to dateRes
        $reservationCour->setDateRes(new \DateTime());

        $form = $this->createForm(ReservationCoursType::class, $reservationCour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationCour);
            $entityManager->flush();

            // Add a flash message for success
            $this->addFlash('success', 'Reservation created successfully!');

            return $this->redirectToRoute('app_reservation_cours_index');
        }

        return $this->renderForm('reservation_cours/new.html.twig', [
            'reservation_cour' => $reservationCour,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_reservation_cours_show', methods: ['GET'])]
    public function show(ReservationCours $reservationCour): Response
    {
        return $this->render('reservation_cours/show.html.twig', [
            'reservation_cour' => $reservationCour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationCours $reservationCour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationCoursType::class, $reservationCour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_cours/edit.html.twig', [
            'reservation_cour' => $reservationCour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_cours_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationCours $reservationCour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationCour->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservationCour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_cours_index', [], Response::HTTP_SEE_OTHER);
    }
}
