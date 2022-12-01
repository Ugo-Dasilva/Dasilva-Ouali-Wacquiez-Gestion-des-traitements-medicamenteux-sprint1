<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Medicament;

class MedicamentController extends AbstractController
{
    #[Route('/medicament', name: 'app_medicament')]
    public function index(): Response
    {
        return $this->render('medicament/index.html.twig', [
            'controller_name' => 'MedicamentController',
        ]);
    }

    #[Route('/medicament', name: 'app_medicament')]
    public function AfficherLesMedicaments(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Medicament::class);
        $lesMedicaments = $repository -> findAll();
        return $this->render('medicament/affichage.html.twig', [
            'controller_name' => 'MedicamentController',
            'lesMedicaments' => $lesMedicaments,
        ]);



    }

     
#[Route('/affichageUnMedicament/{id}', name: 'app_medicamentId')]
public function AfficherLeTraitement(ManagerRegistry $doctrine,$id): Response
{
   $repository=$doctrine->getRepository(Medicament::class);
   
   $unMedicament=$repository->find($id);
   return $this->render('medicament/medicamentAvecId.html.twig', [
    'medicament' => $unMedicament,
    ]);
}


}
