<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sejour;
use Doctrine\Persistence\ManagerRegistry;

class SejourController extends AbstractController
{
    #[Route('/sejour', name: 'app_sejour')]
    public function index(): Response
    {
        return $this->render('sejour/index.html.twig', [
            'controller_name' => 'SejourController',
        ]);
    }
    #[Route('/sejours', name: 'app_sejours')]
    public function AfficherLessejours(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Sejour::class);
        $lesSejour = $repository -> findAll();
        return $this->render('sejour/affichage.html.twig', [
            'controller_name' => 'SejourController',
            'sejour' => $lesSejour,
        ]);





    }
    #[Route('/affichageUnSejours/{id}', name: 'app_sejourId')]
    public function AfficherLeSejour(ManagerRegistry $doctrine,$id): Response
{
   $repository=$doctrine->getRepository(Sejour::class);
   $unSejour=$repository->find($id);
   return $this->render('sejour/sejourAvecId.html.twig', [
    'sejour' => $unSejour,
    ]);
}
}
