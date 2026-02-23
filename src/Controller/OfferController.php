<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Form\ArtFormType;
use App\Repository\OfferRepository;
use App\Repository\ReservationOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Knp\Snappy\Pdf;

#[Route('/offer')]
class OfferController extends AbstractController
{
    #[Route('/', name: 'app_offer_index', methods: ['GET'])]
    public function index(OfferRepository $offerRepository): Response
    {
        return $this->render('offer/index.html.twig', [
            'offers' => $offerRepository->findAll(),
        ]);
    }

    #[Route('/search', name: 'search_offer', methods: ['GET'])]
    public function searchOffer(Request $request, OfferRepository $repo): Response
    {
        $query = $request->query->get('q');
        $results = $repo->searchByTitle($query);
        $results2 = $repo->searchByDec($query);
        $results3 = $repo->searchByPrix($query);
        $results4 = $repo->searchByDateD($query);
        $results5 = $repo->searchByDateF($query);
        $results6 = $repo->searchByNBR($query);
        $results7 = $repo->searchByNBMAX($query);

    
        return $this->render('offer/_search_results.html.twig', [
            'results' => $results,
            'results2' => $results2,
            'results3' => $results3,
            'results4' => $results4,
            'results5' => $results5,
            'results6' => $results6,
            'results7' => $results7,
        ]);
    }

   /* #[Route('/new', name: 'app_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }*/

    #[Route('/new', name: 'app_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OfferRepository $offerRepository): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offerRepository->save($offer, true);

            return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }



    #[Route('/generate-stat', name: 'generate_stat', methods: ['GET'])]
    public function generatePdf(OfferRepository $offerRepository ,ReservationOfferRepository $repo, Pdf $pdf): Response
    {
        // Retrieve data from the repository
       // $data = $offerRepository->getChartData(); // Implement this method in your OfferRepository
       $data = [];
        $offers = $offerRepository->findAll(); // Assumption: Fetch all offers from the repository

        /*foreach ($offers as $offer) {
            $data[$offer->getTitleOffer()] = $repo->getCountByTypeOffer($offer->getTitleOffer());
        }*/
        foreach ($offers as $offer) {
            $data[] = [
                'label' => $offer->getTitleOffer(),
                'y' => $repo->getCountByTypeOffer($offer->getTitleOffer()),
            ];
        }
        
        dump($data);

        // Render the Twig template with the retrieved data
        $html = $this->renderView('offer/stat.html.twig', [
            'data' => $data,
        ]);
    
        // Specify the correct path to wkhtmltopdf when creating Pdf instance
        $pdfPath = '/usr/local/bin/wkhtmltopdf';
        $pdf = new Pdf($pdfPath);
    
        // Generate PDF from the HTML
        $response = new Response(
            $pdf->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', 'chart.pdf'),
            ]
        );
    
        return $response;
    }


    
    
    


    #[Route('/generate-excel-and-stats', name: 'generate_excel_and_stats', methods: ['GET'])]
public function generateExcelAndStats( EntityManagerInterface $entityManager, KernelInterface $kernel): BinaryFileResponse
{

    //$stats = $this->$offer->nb_reservation;
    //$offersWithStats = $offerRepository->getOffersWithReservationStats();
    $offers = $entityManager->getRepository(Offer::class)->findAll();

    $excelFilePath = $this->generateExcel($offers, $kernel);
    return $this->file($excelFilePath);
}



private function generateExcel(array $offers, KernelInterface $kernel): string
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Ajoutez vos données Excel ici, par exemple :
    $sheet->setCellValue('A1', 'Titre');
    $sheet->setCellValue('B1', 'Description');
    $sheet->setCellValue('C1', 'Prix');
    $sheet->setCellValue('D1', 'Date debut');
    $sheet->setCellValue('E1', 'Date Fin');
    $sheet->setCellValue('F1', 'Nombre de reservation');

    // Remplir les données de l'offre avec la statistique basée sur les prix
    foreach ($offers as $key => $offer) {
        $row = $key + 2; // Commencer à partir de la deuxième ligne (1-based index)

        $sheet->setCellValue('A' . $row, $offer->getTitleoffer());
        $sheet->setCellValue('B' . $row, $offer->getDescriptionoffer());
        $sheet->setCellValue('C' . $row, $offer->getPrix());
        $sheet->setCellValue('D' . $row, $offer->getDatedeboffer());
        $sheet->setCellValue('E' . $row, $offer->getDatefinoffer());
        $sheet->setCellValue('F' . $row, $offer->getnb_reservation());
    }

    $excelFilePath = $kernel->getProjectDir() . '/public/uploads/offer/excel.xlsx';

    $writer = new Xlsx($spreadsheet);
    $writer->save($excelFilePath);

    return $excelFilePath;
}



    #[Route('/{idoffer}', name: 'app_offer_show', methods: ['GET'])]
    public function show(Offer $offer,OfferRepository $offerRepository, $idoffer): Response
    {
        //$offers = $offerRepository->findAll();
        $offer = $offerRepository->find($idoffer);

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont','Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        $dompdf= new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl'=>[
                'verify_peer'=>FALSE,
                'verify_peer_name'=>FALSE,
                'allow_self_signed'=>TRUE,
            ]
        ]);

        $dompdf->setHttpContext($context);
        // génere le html
        $html = $this->renderView('offer/downloadf.html.twig', [
            'offer' => $offer,
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $fichier = 'Offer'.'.pdf';
        ob_get_clean();


        $dompdf->stream($fichier,[
            'Attachment'=>true,
        ]);
        return new Response();
        /*return $this->render('offer/show.html.twig', [
            'offer' => $offer,
        ]);*/
    }

    /*#[Route('/{idoffer}/edit', name: 'app_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offer $offer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }*/

    

    #[Route('/{idoffer}/edit', name: 'app_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offer $offer, OfferRepository $offerRepository): Response
    {

            $form = $this->createForm(ArtFormType::class, $offer);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $offerRepository->save($offer, true);
    
                return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
            }
            return $this->renderForm('offer/edit.html.twig', [
                'offer' => $offer,
                'form' => $form,
            ]);
    }

    #[Route('/{idoffer}', name: 'app_offer_delete', methods: ['POST'])]
    public function delete(Request $request, Offer $offer, OfferRepository $offerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offer->getIdoffer(), $request->request->get('_token'))) {
            $offerRepository->remove($offer, true);
        }

        return $this->redirectToRoute('app_offer_index', [], Response::HTTP_SEE_OTHER);
    }
}
