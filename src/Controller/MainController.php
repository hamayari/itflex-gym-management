<?php

namespace App\Controller;

use App\Repository\ActivitesRepository;

use App\Repository\EquipementRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]

    public function index(ActivitesRepository $activitesRepository)
    {
        $events = $activitesRepository->findAll();
        $categoryColors = [
            'Aquatique' => '#33A6FF',
            'Force' => '#FF334F',
            'Souplesse' => '#33FF7E',
            'Cardio' => '#8A19B1',
            'Training' => '#38CECB',
            'Danse' =>'#ED59DD',
            'Kids Island' =>'#EDC82B'

        ];

        $rdvs = [];

        foreach($events as $event){
            $category = $event->getIdcategorie()->getCategorie(); // Assuming getName() returns the category name
            $backgroundColor = $categoryColors[$category] ?? '#CCCCCC'; // Default to a fallback color if category not found
            $coach = $event->getIdUser()->getNom();
            $title = $event->getTitre() . ' (' . $coach . ')';
            $rdvs[] = [
                'id' => $event->getCode(),
                'start' => $event->getDateDeb()->format('Y-m-d H:i:s'),
                'end' => $event->getDateFin()->format('Y-m-d H:i:s'),
                'title' => $title,
                //'description' => $event->getDescription(),
                'backgroundColor' => $backgroundColor,
                 'borderColor' => '#FFFFFF',
                //'' => $event->getTextColor(),
                //'coach' => $event->getIdUser(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('main/index.html.twig', compact('data'));
    }
    #[Route('/mainn', name: 'app_mainn')]
    public function indexx(ActivitesRepository $activitesRepository)
    {
        $events = $activitesRepository->findAll();
        $categoryColors = [
            'Aquatique' => '#33A6FF',
            'Force' => '#FF334F',
            'Souplesse' => '#33FF7E',
            'Cardio' => '#8A19B1',
            'Training' => '#38CECB',
            'Danse' =>'#ED59DD',
            'Kids Island' =>'#EDC82B'

        ];

        $rdvs = [];

        foreach($events as $event){
            $category = $event->getIdcategorie()->getCategorie(); // Assuming getName() returns the category name
            $backgroundColor = $categoryColors[$category] ?? '#CCCCCC'; // Default to a fallback color if category not found
            $coach = $event->getIdUser()->getNom();
            $title = $event->getTitre() . ' (' . $coach . ')';
            $rdvs[] = [
                'id' => $event->getCode(),
                'start' => $event->getDateDeb()->format('Y-m-d H:i:s'),
                'end' => $event->getDateFin()->format('Y-m-d H:i:s'),
                'title' => $title,
                //'description' => $event->getDescription(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => '#FFFFFF',
                //'' => $event->getTextColor(),
                //'coach' => $event->getIdUser(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('main/backcalendar.html.twig', compact('data'));
    }
    #[Route('/mainnn', name: 'app_main_back')]
    public function indexSaid(EquipementRepository $equipement): Response
    {
        
          $events = $equipement->findAll();
           foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getIdEquipement(),
                'start' => $event->getDateAchat()->format('Y-m-d H:i:s'),
              
    
            ];
            
           }
    
           $data =json_encode($rdvs);
    
            return $this->render('mainBack/main.html.twig', compact('data'));
        
        }

}
