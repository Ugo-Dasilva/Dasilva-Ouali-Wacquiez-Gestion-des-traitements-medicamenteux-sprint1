<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

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
            'Medicaments' => $lesMedicaments,
        ]);



    }


}
