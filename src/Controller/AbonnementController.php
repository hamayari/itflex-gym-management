<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Form\AbonnementType;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeAbonn;
use App\Entity\Offer;
use App\Entity\User;
use App\Repository\TypeAbonnRepository;
use App\Repository\OfferRepository;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\PhoneNumber;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Security\Core\Security;
use Twilio\Rest\Client;

#[Route('/abonnement')]
class AbonnementController extends AbstractController
{
    /*#[Route('/', name: 'app_abonnement_index', methods: ['GET'])]
    public function index(AbonnementRepository $abonnementRepository): Response
    {
        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnementRepository->findAll(),
        ]);
    }*/

    #[Route('/', name: 'affiche_TypeAbonn', methods: ['GET'])]
    public function index(TypeAbonnRepository $typeAbonnRepository,OfferRepository $offerRepository): Response
    {
        $offers = $this->getDoctrine()->getRepository(Offer::class)->findAll();
        return $this->render('abonnement/afiiche_TypeAbonn.html.twig', [
            'type_abonns' => $typeAbonnRepository->findAll(),
            'offers' => $offers,
        ]);
    }

    #[Route('/AfiicheOffer', name: 'AfiicheOffer', methods: ['GET'])]
    public function AfiicheOffer(OfferRepository $offerRepository): Response
    {
        $offers = $this->getDoctrine()->getRepository(Offer::class)->findAll();

        return $this->render('abonnement/AfiicheOffer.html.twig', [
            'offers' => $offers,
        ]);
    }


    #[Route('/new/{id}', name: 'app_abonnement_new', methods: ['GET', 'POST'])]
        public function new(Request $request, EntityManagerInterface $entityManager, $id, NotifierInterface $notifier, Security $security): Response
        {
            $typeAbonn = $entityManager->getRepository(TypeAbonn::class)->find($id);
    
            if (!$typeAbonn) {
                throw $this->createNotFoundException('TypeAbonn not found');
            }
    
            $abonnement = new Abonnement();
            $abonnement->setTypeabon($typeAbonn);
    
            $form = $this->createForm(AbonnementType::class, $abonnement);
            $form->handleRequest($request);
            $verificationCode = random_int(100000, 999999);
            $abonnement->setVerificationCode($verificationCode);

            if ($form->isSubmitted() && $form->isValid()) {
               
    
                $selectedUserId = $request->request->get('abonnement')['iduser'];
                $user = $entityManager->getRepository(User::class)->find((int) $selectedUserId);
    
                if (!$user) {
                    throw $this->createNotFoundException('User not found');
                }
    
                $abonnement->setIduser($user);
    
                $entityManager->persist($abonnement);
                $entityManager->flush();
    
                $this->sendVerificationCode($abonnement, $user);
    
                // Redirect to the verification page
                return $this->redirectToRoute('verification_page', ['id' => $abonnement->getIdabonement()]);
            }
    
            return $this->renderForm('abonnement/new.html.twig', [
                'abonnement' => $abonnement,
                'form' => $form,
            ]);
        }

        #[Route('/verify-code/{id}', name: 'verification_page', methods: ['GET', 'POST'])]
        public function verifyCode(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
        {
            if ($request->isMethod('POST')) {
                $enteredCode = $request->request->get('verification_code');
                $generatedCode = $abonnement->getVerificationCode();
    
                if ($enteredCode == $generatedCode) {
                    $this->updateAbonnementAfterVerification($abonnement);
    
                    $this->addFlash('success', 'Verification successful!');
                    return $this->redirectToRoute('affiche_TypeAbonn');
                } else {
                    $this->addFlash('error', 'Invalid verification code. Please try again.');
                }
            }
    
            return $this->render('abonnement/verify_code.html.twig', [
                'abonnement' => $abonnement,
            ]);
        }

        private function updateAbonnementAfterVerification(Abonnement $abonnement): void
        {
            $entityManager = $this->getDoctrine()->getManager();
            $abonnement->getTypeabon()->setnb_abonnement($abonnement->getTypeabon()->getnb_abonnement() + 1);
            $entityManager->persist($abonnement);
            $entityManager->flush();
        }
        private function sendVerificationCode(Abonnement $abonnement, User $user): void
        {
            $verificationCode = $abonnement->getVerificationCode();    
            $str = (string) $verificationCode;

            $sid = $this->getParameter('twilio_account_sid');
            $token = $this->getParameter('twilio_auth_token');
            $twilioPhoneNumber = $this->getParameter('twilio_phone_number');
            
            $twilio = new Client($sid, $token);
            $phoneNumber = '+216' . $user->getNumtel();
            $message = $twilio->messages
                ->create($phoneNumber, // to
                    array(
                        "from" => $twilioPhoneNumber,
                        "body" => "GYM.tn : Votre code de confirmation est ".$str
                    )
                );
        }


    #[Route('/{idabonement}', name: 'app_abonnement_show', methods: ['GET'])]
    public function show(Abonnement $abonnement): Response
    {
        return $this->render('abonnement/show.html.twig', [
            'abonnement' => $abonnement,
        ]);
    }

    /*#[Route('/{idabonement}/edit', name: 'app_abonnement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('affiche_TypeAbonn', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('abonnement/edit.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
        ]);
    }*/

    #[Route('/{idabonement}', name: 'app_abonnement_delete', methods: ['POST'])]
    public function delete(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonnement->getIdabonement(), $request->request->get('_token'))) {
            $entityManager->remove($abonnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('affiche_TypeAbonn', [], Response::HTTP_SEE_OTHER);
    }
}
