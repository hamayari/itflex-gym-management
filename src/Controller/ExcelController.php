<?php

namespace App\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Equipement;

class ExcelController extends AbstractController
{
    #[Route('/excel', name: 'export_Excel')]
    public function exportEquipements(): Response
    {
        // Récupération des données 
        $equipements = $this->getDoctrine()->getRepository('App\Entity\Equipement')->findAll();

        // Création d'un objet Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Sélection de la feuille active
        $sheet = $spreadsheet->getActiveSheet();

        // En-têtes du fichier Excel
        // Add headers to the sheet
        $sheet->setCellValue('A1', 'IdEquipement');
        $sheet->setCellValue('B1', 'NomEquipement');
        $sheet->setCellValue('C1', 'Quantite');
        $sheet->setCellValue('D1', 'DateAchat');
        $sheet->setCellValue('E1', 'PrixAchat');
        
         // Get the equipment from the database using Doctrine ORM
        $equipments = $this->getDoctrine()->getRepository(Equipement::class)->findAll();

        // Ajout des données
        $row = 2;
        foreach ($equipements as $equipement) {
            $sheet->setCellValue('A' . $row, $equipement->getIdEquipement());
            $sheet->setCellValue('B' . $row, $equipement->getNomEquipement());
            $sheet->setCellValue('C' . $row, $equipement->getQuantite());
            $sheet->setCellValue('D' . $row, $equipement->getDateAchat()->format('Y-m-d'));
            $sheet->setCellValue('E' . $row, $equipement->getPrixAchat());
            // ... Ajoutez d'autres cellules selon les informations des équipements

            $row++;
        }

        // Nom du fichier Excel
        $filename = 'equipements.xlsx';

        // Création d'un objet Writer
        $writer = new Xlsx($spreadsheet);

        // Sauvegarde du fichier Excel
        $writer->save($filename);

        // Return the Excel file as a response
        return $this->file($filename);
    }
}

