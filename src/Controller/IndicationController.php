<?php

namespace App\Controller;

use App\Entity\Indication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

class IndicationController extends AbstractController
{
    #[Route('/indication', name: 'app_indication')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Indication::class);
        $lesIndications = $repository -> findAll();
        return $this->render('indication/affichage.html.twig', [
            'controller_name' => 'IndicationController',
            'lesindications' => $lesIndications,
        ]);
    }

    #[Route('/AffichageuneIndication/{id}', name: 'app_affichage_indication')]
    public function Afficher(ManagerRegistry $doctrine,$id): Response
    {   
        $repository = $doctrine->getRepository(Indication::class);
        $lesIndications = $repository ->find($id);
        return $this->render('indication/index.html.twig', [
            'controller_name' => 'IndicationController',
            'lesindications' => $lesIndications,
        ]);
    }

}