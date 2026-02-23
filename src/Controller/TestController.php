<?php

namespace App\Controller;

use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/frontequipement', name: 'app_equipement_index_front', methods: ['GET'])]
    public function indexequipement(EquipementRepository $equipementRepository): Response
    {
        return $this->render('equipement/indexfront.html.twig', [
            'equipements' => $equipementRepository->findAll(),
        ]);
    }


}
