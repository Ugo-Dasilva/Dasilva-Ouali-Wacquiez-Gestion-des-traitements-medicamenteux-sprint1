<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TraitementController extends AbstractController
{
    #[Route('/traitement', name: 'app_traitement')]
    public function index(): Response
    {
        return $this->render('traitement/index.html.twig', [
            'controller_name' => 'TraitementController',
        ]);
    }
    

    #[Route('/affichageTraitements', name: 'app_traitements')]
   public function AfficherLesTraitements(ManagerRegistry $doctrine): Response
   {
       $repository = $doctrine->getRepository(Traitement::class);
       $lesTraitements = $repository -> findAll();
       return $this->render('traitement/index.html.twig', [
           'controller_name' => 'TraitementController',
           'traitements' => $lesTraitements,
       ]);
    }

    #[Route('/affichageUnTraitement/{id}', name: 'app_traitementId')]
        public function AfficherLeTraitement(ManagerRegistry $doctrine,$id): Response
        {
           $repository=$doctrine->getRepository(Traitement::class);
           
           $unTraitement=$repository->find($id);
           return $this->render('traitement/traitementAvecId.html.twig', [
            'traitement' => $unTraitement,
            ]);
        }
}
