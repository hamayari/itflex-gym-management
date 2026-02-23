<?php

namespace App\Controller;

use App\Entity\ReservationOffer;
use App\Entity\Offer;
use App\Form\ReservationOfferType;
use App\Repository\ReservationOfferRepository;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[Route('/reservation/offer', name: 'reservation_offer')]
class ReservationOfferController extends AbstractController
{
    #[Route('/', name: 'app_reservation_offer_index', methods: ['GET'])]
    public function index(ReservationOfferRepository $reservationOfferRepository,OfferRepository $offerRepository): Response
    {
        //$offers = $this->getDoctrine()->getRepository(Offer::class)->findAll();
        $offers = $offerRepository->listOfferBynb_reservations();
        return $this->render('reservation_offer/index.html.twig', [
            
            'reservation_offers' => $reservationOfferRepository->findAll(),
            'offers' => $offers,
        ]);
    }

    #[Route('/new_reservation_offer/{id}', name: 'new_reservation_offer', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $id, MailerInterface $mailer): Response
    {
       // Recherchez l'offre par son ID
       $offer = $entityManager->getRepository(Offer::class)->find($id);

        if (!$offer) {
        throw $this->createNotFoundException('L\'offre n\'existe pas');
        }
        $reservationOffer = new ReservationOffer();
        $reservationOffer->setIdoffer($offer);

        $form = $this->createForm(ReservationOfferType::class, $reservationOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $offer = $reservationOffer->getIdoffer();
        if ($offer->getnb_max_reservation() > $offer->getnb_reservation()) {

            //$nb =  $reservationOffer->getIdoffer()->getnb_reservation() + 1;
            //$reservationOffer->getIdoffer()->setnb_reservation($nb);
            //$reservationOffer->setDatereservation(new \DateTime());
            $nb = $offer->getnb_reservation() + 1;
            $offer->setnb_reservation($nb);
            $reservationOffer->setDatereservation(new \DateTime()); 

            $entityManager->persist($reservationOffer);
            $entityManager->flush();

            // Send confirmation email
            $this->sendConfirmationEmail($reservationOffer, $mailer);

            return $this->redirectToRoute('app_reservation_offer_index',[], Response::HTTP_SEE_OTHER);
        }else {
            $this->addFlash('danger', 'No more available reservations for this offer.');
        }
    }

        return $this->renderForm('reservation_offer/new.html.twig', [
            'reservation_offer' => $reservationOffer,
            'form' => $form,
        ]);
    }

    // Add a method to send confirmation email
private function sendConfirmationEmail(ReservationOffer $reservationOffer, MailerInterface $mailer): void
{
    //$userEmail = $reservationOffer->getIduser()->getEmail();
    $offerName = $reservationOffer->getIdoffer()->getTitleoffer();

    $email = (new Email())
        ->from('chayma.attafi@esprit.tn')
        ->to('chaymaattafi3@gmail.com')
        ->subject('Reservation Confirmation')
        ->html("Thank you for your reservation for the offer: $offerName. Your reservation is confirmed.");

    $mailer->send($email);
            
}

    #[Route('/{idreservation}', name: 'app_reservation_offer_show', methods: ['GET'])]
    public function show(ReservationOffer $reservationOffer): Response
    {
        return $this->render('reservation_offer/show.html.twig', [
            'reservation_offer' => $reservationOffer,
        ]);
    }

    #[Route('/{idreservation}/edit', name: 'app_reservation_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationOffer $reservationOffer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationOfferType::class, $reservationOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_offer/edit.html.twig', [
            'reservation_offer' => $reservationOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{idreservation}', name: 'app_reservation_offer_delete', methods: ['POST'])]
    public function delete(Request $request, Offer $offer, ReservationOffer $reservationOffer, EntityManagerInterface $entityManager): Response
    {
        $reservationOffer = $offer->getnb_reservation()();

        if ($this->isCsrfTokenValid('delete'.$reservationOffer->getIdreservation(), $request->request->get('_token')) && $reservationOffer==0) {
            $entityManager->remove($reservationOffer);
            $entityManager->flush();
        }
        else {
            return  $this->render('reservation_offer/errorDelete.html.twig');
        }

        return $this->redirectToRoute('app_reservation_offer_index', [], Response::HTTP_SEE_OTHER);
    }
}
