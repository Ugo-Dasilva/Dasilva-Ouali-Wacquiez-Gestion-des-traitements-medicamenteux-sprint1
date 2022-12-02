<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Patient;


class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_patient')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Patient::class);
        $lespatients = $repository ->findAll();
        return $this->render('patient/index.html.twig', [
            'lespatients' => $lespatients,
        ]);
    }

    #[Route('/patientaffichage/{id}', name: 'app_affichage_patient')]
    public function Afficher(ManagerRegistry $doctrine,$id): Response
    {   
        $repository = $doctrine->getRepository(Patient::class);
        $lespatients = $repository ->find($id);
        return $this->render('patient/affichage.html.twig', [
            'lespatients' => $lespatients,
        ]);
    }

}
