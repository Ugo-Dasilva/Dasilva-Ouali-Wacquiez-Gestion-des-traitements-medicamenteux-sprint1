<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EffetssecondaireController extends AbstractController
{
    #[Route('/effetssecondaire', name: 'app_effetssecondaire')]
    public function index(): Response
    {
        return $this->render('effetssecondaire/index.html.twig', [
            'controller_name' => 'EffetssecondaireController',
        ]);
    }
}
