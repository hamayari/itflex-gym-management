<?php

namespace App\Controller;

use App\Entity\Activites;
use App\Form\ActivitesType;
use App\Repository\ActivitesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/activites')]
class ActivitesController extends AbstractController
{
    #[Route('/search', name: 'app_activites_search', methods: ['GET'])]
    public function search(Request $request, ActivitesRepository $activitesRepository): Response
    {
        $title = $request->query->get('title');
        $salle = $request->query->get('salle');
        $dateDeb = $request->query->get('dateDeb');

        // Check if both title and salle are present
        if ($title && $salle) {
            $activites = $activitesRepository->findByField('titre', $title, $dateDeb);
            // Filter the result further by salle
            $activites = array_filter($activites, function ($activite) use ($salle) {
                return stripos($activite->getSalle(), $salle) !== false;
            });
        } else {
            // Use the combined function to search by title or salle
            $activites = $activitesRepository->findByField($title ? 'titre' : 'salle', $title ?: $salle, $dateDeb);
        }



return $this->render('activites/index.html.twig', [
            'activites' => $activites,
        ]);
    }

    #[Route('/', name: 'app_activites_index', methods: ['GET'])]
    public function index(ActivitesRepository $activitesRepository): Response
    {
        return $this->render('activites/index.html.twig', [
            'activites' => $activitesRepository->findAll(),
        ]);
    }
    #[Route('/list', name: 'app_activites', methods: ['GET'])]
    public function indexfront(ActivitesRepository $activitesRepository): Response
    {
        return $this->render('activites/index_front.html.twig', [
            'activites' => $activitesRepository->findAll(),
        ]);
    }

    // ...

    #[Route('/new', name: 'app_activites_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activite = new Activites();
        // Initialiser les champs dateDeb et dateFin avec la date actuelle
        $activite->setDateDeb(new \DateTime());
        $activite->setDateFin(new \DateTime());

        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the current week's activity
            $entityManager->persist($activite);
            $entityManager->flush();

            // Clone activities for the next month
            $this->cloneActivitiesForNextMonth($activite, $entityManager);

            return $this->redirectToRoute('app_activites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activites/new.html.twig', [
            'activite' => $activite,
            'form' => $form,
        ]);
    }

// Function to clone activities for the next month
    private function cloneActivitiesForNextMonth(Activites $activity, EntityManagerInterface $entityManager): void
    {
        // Assuming $entityManager is an instance of EntityManagerInterface
        $weeksToClone = 4; // Clone for four weeks (one month)

        for ($i = 0; $i < $weeksToClone; $i++) {
            $nextWeekActivity = $this->cloneActivityForNextWeek($activity);
            $entityManager->persist($nextWeekActivity);
            $entityManager->flush();
            // Set the cloned activity as the current activity for the next iteration
            $activity = $nextWeekActivity;
        }
    }

// Function to clone a single activity for the next week
    private function cloneActivityForNextWeek(Activites $activity): Activites
    {
        $newActivity = clone $activity;
        $newActivity->setDateDeb($activity->getDateDeb()->modify('+1 week'));
        $newActivity->setDateFin($activity->getDateFin()->modify('+1 week'));

        // Optionally reset other properties if needed

        return $newActivity;
    }



    #[Route('/{code}', name: 'app_activites_show', methods: ['GET'])]
    public function show(Activites $activite): Response
    {
        return $this->render('activites/show.html.twig', [
            'activite' => $activite,
        ]);
    }

    #[Route('/{code}/edit', name: 'app_activites_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activites $activite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_activites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activites/edit.html.twig', [
            'activite' => $activite,
            'form' => $form,
        ]);
    }

    #[Route('/{code}', name: 'app_activites_delete', methods: ['POST'])]
    public function delete(Request $request, Activites $activite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activite->getCode(), $request->request->get('_token'))) {
            $entityManager->remove($activite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_activites_index', [], Response::HTTP_SEE_OTHER);
    }
}
