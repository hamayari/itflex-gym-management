<?php

namespace App\Controller;

use App\Entity\Commande;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\User;
use App\Entity\produit;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CommandeProduit;
use Psr\Log\LoggerInterface;

#[Route('/commande')]
class CommandeController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    #[Route('/Commande/{id}/pdf', name: 'app_pdf')]
    public function pdf(Request $request, EntityManagerInterface $entityManager,$id): Response
    {
        $idCommande = $id;

        // Récupérez la commande à partir de l'id_commande
        $commande = $entityManager->getRepository(Commande::class)->find($idCommande);

        if (!$commande) {
            throw $this->createNotFoundException('Commande non trouvée');
        }

        // Récupérez le contenu HTML de la vue Twig
        $html = $this->renderView('pdf_template.twig', ['commande' => $commande]);

        // Configurez Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Définissez le format du papier (A4 par défaut)
        $dompdf->setPaper('A4', 'portrait');

        // Rendez le PDF
        $dompdf->render();

        // Renvoyez la réponse avec le contenu du PDF
        $response = new Response($dompdf->output());
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'inline; filename="commande_'.$idCommande.'.pdf"');

        return $response;
    }
    #[Route('/', name: 'app_commande_index', methods: ['GET'])]
    public function index(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Obtenez l'utilisateur actuellement connecté (peut-être à partir du système de sécurité Symfony)
        $currentUser = $this->getUser();
    
        // Créez une nouvelle commande et associez l'utilisateur actuel
        $commande = new Commande();
        $commande->setIduser($currentUser);
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        $UserRepository = $entityManager->getRepository(User::class);
        if ($form->isSubmitted() && $form->isValid()) {
            $user=$UserRepository->findOneByEmail($form->get('iduser')->getData());
            if ($user) {
                $commande->setIduser($user);
            } else {
                // Gérer le cas où aucun utilisateur n'est trouvé avec cet e-mail
                // Afficher un message dans la console ou le terminal
                $this->logger->error('Aucun utilisateur trouvé avec l\'e-mail spécifié.');
                // Vous pouvez également lancer une exception ou effectuer une autre action en conséquence.
            }

            $commande->setDate($form->get('date')->getData());
            $commande->setAdresse($form->get('adresse')->getData());
            $commande->setType($form->get('type')->getData());
            $entityManager->persist($commande);
            // Gestion des produits
            $produits = $form->get('produits')->getData();
            foreach ($produits as $produit) {
                $CommandeProduit= new CommandeProduit();
                $CommandeProduit->setCommandes($commande);
                $CommandeProduit->setProduits($produit);
                $entityManager->persist($CommandeProduit);
            }
            $entityManager->flush();
    
            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('commande/new.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{id}', name: 'app_commande_show', methods: ['GET'])]
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeType::class);
        $form->get('date')->setData($commande->getDate());
        $form->get('adresse')->setData($commande->getAdresse());
        $form->get('type')->setData($commande->getType());
        $comandeProduis = $commande->getCommandeProduits();
        $prduits = [];
        foreach ($comandeProduis as $commandeProduit) {
            $prduits[] = $commandeProduit->getProduits();
        }
        $form->get('produits')->setData($prduits);
        $form->get('iduser')->setData($commande->getIduser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion des produits
            $produits = $form->get('produits')->getData();
            $UserRepository = $entityManager->getRepository(User::class);
            $user=$UserRepository->findOneByEmail($form->get('iduser')->getData());
            if ($user) {
                $commande->setIduser($user);
            } else {
                // Gérer le cas où aucun utilisateur n'est trouvé avec cet e-mail
                // Afficher un message dans la console ou le terminal
                $this->logger->error('Aucun utilisateur trouvé avec l\'e-mail spécifié.');
                // Vous pouvez également lancer une exception ou effectuer une autre action en conséquence.
            }
            $commande->setDate($form->get('date')->getData());
            $commande->setAdresse($form->get('adresse')->getData());
            $commande->setType($form->get('type')->getData());
            foreach ($commande->getCommandeProduits() as $cmproduit) {
                $entityManager->remove($cmproduit);
            }
            foreach ($produits as $produit) {
                $CommandeProduit= new CommandeProduit();
                $CommandeProduit->setCommandes($commande);
                $CommandeProduit->setProduits($produit);
                $entityManager->persist($CommandeProduit);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_commande_delete', methods: ['POST'])]
    public function delete(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $commande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
    }
}
