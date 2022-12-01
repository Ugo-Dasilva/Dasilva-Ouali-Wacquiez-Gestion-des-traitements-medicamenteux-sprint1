<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sejour;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SejourType;

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
#[Route('/formulaire_add_sejour' , name: 'formulaire_add_sejour')]
    public function formulaire_ajoutSej(ManagerRegistry $doctrine , Request $request):Response {
        $em=$doctrine->getManager();
        $Sejour=new Sejour();
        $form =$this->createForm(SejourType::class,$Sejour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $Sejour=$form->getData();
            $em->persist($Sejour);
            $em->flush();
            return $this->redirectToRoute('app_sejours');
        }
        return $this->render ('sejour/formulaire.html.twig',array(
            'form'=> $form->createView(),
        ));

        

        }
        #[Route('/formulaire_modif_sejour/{id}' , name: 'formulaire_modif_sejour')]
    public function formulaire_modifMed(ManagerRegistry $doctrine , $id,Request $request):Response {
        $em=$doctrine->getManager();
        $repository=$doctrine->getRepository(Sejour::class);
        $Sejour=$repository->find($id);
        $form =$this->createForm(SejourType::class,$Sejour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $Sejour=$form->getData();
            $em->persist($Sejour);
            $em->flush();
            return $this->redirectToRoute('app_sejours');
        }
        return $this->render ('sejour/formulaire.html.twig',array(
            'form'=> $form->createView(),
        ));

        

        }
        #[Route('/suppSejour/{id}', name: 'app_suppSejour')]
        public function SuppSejour(ManagerRegistry $doctrine,$id): Response
        {
           $repository=$doctrine->getRepository(Sejour::class);
           // Récupération de tous les adhérents
           $Sejour=$repository->find($id);
           $em=$doctrine->getManager();
           $em->remove($Sejour);
           $em->flush();
           return $this->redirectToRoute('app_sejours');
        }
}
