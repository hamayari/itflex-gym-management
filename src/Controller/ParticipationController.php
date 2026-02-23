<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Repository\EventsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\TwilioService;

use App\Repository\ParticipationRepository;
use App\Form\ParticipationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participation')]
class ParticipationController extends AbstractController
{
    #[Route('/', name: 'app_participation_index', methods: ['GET'])]
    public function index(ParticipationRepository $participationRepository): Response
    {
        return $this->render('participation/index.html.twig', [
            'participations' => $participationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_participation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session , TwilioService $twilioService): Response
    {
        $participation = new Participation();
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check available places before persisting
            $event = $participation->getIdevent();
            $availablePlaces = $event->getNombreplacestotal() - $event->getNombreplacesreservees();

            if ($availablePlaces > 0) {
                
                $event->setNombreplacesreservees($event->getNombreplacesreservees() + 1);
                $participation->setDatepart(new \DateTime()); 

                $entityManager->persist($participation);
                $entityManager->flush();
                // Envoyer un SMS
            $to =$participation->getNtel(); // Numéro de téléphone du destinataire
            $messageBody = 'Votre Reservation est confirmé';

            $messageSid = $twilioService->sendSMS($to, $messageBody);

                return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
            } else {
                
                $this->addFlash('error', 'No available places for this event.');

                

            }
        }

        return $this->renderForm('participation/new.html.twig', [
            'participation' => $participation,
            'form' => $form,
        ]);
    }

    #[Route('/{idpart}', name: 'app_participation_show', methods: ['GET'])]
    public function show(Participation $participation): Response
    {
        return $this->render('participation/show.html.twig', [
            'participation' => $participation,
        ]);
    }

    #[Route('/{idpart}/edit', name: 'app_participation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participation/edit.html.twig', [
            'participation' => $participation,
            'form' => $form,
        ]);
    }

    #[Route('/{idpart}', name: 'app_participation_delete', methods: ['POST'])]
    public function delete(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getIdpart(), $request->request->get('_token'))) {
            // Get the event associated with the participation
            $event = $participation->getIdevent();
            $event->setNombreplacesreservees($event->getNombreplacesreservees() - 1);
    
            // Remove associated reservations
           /* $participations = $event->getParticipation();
            foreach ($participations as $participation) {*/
                $entityManager->remove($participation);
        //    }
    
           
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
    }
    
    public function sendSmsAction(TwilioService $twilioService)
    {
        // Utilisez le service TwilioService pour envoyer un SMS
        $to = '+21693008976'; // Numéro de téléphone du destinataire
        $messageBody = 'Votre Reservation est confirmé';

        $messageSid = $twilioService->sendSMS($to, $messageBody);

        return $this->json(['messageSid' => $messageSid]);
    }
}
