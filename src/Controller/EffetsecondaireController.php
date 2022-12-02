<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Effetsecondaire;
use App\Form\EffetsecondaireType;

class EffetsecondaireController extends AbstractController
{
    #[Route('/effetsecondaire', name: 'app_effetsecondaire')]
    public function index(): Response
    {
        return $this->render('effetsecondaire/index.html.twig', [
            'controller_name' => 'EffetsecondaireController',
        ]);
    }
    #[Route('/effetsecondaires', name: 'app_effetsecondaires')]
    public function AfficherLeseffetsecondaire(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Effetsecondaire::class);
        $leseffetsecondaires = $repository -> findAll();
        return $this->render('effetsecondaire/affichage.html.twig', [
            'controller_name' => 'EffetsecondaireController',
            'leseffetsecondaires' => $leseffetsecondaires,
        ]);
    }
    #[Route('/affichageUneffetsecondaire/{id}', name: 'app_effetsecondaireId')]
public function Afficheruneffet(ManagerRegistry $doctrine,$id): Response
{
   $repository=$doctrine->getRepository(Effetsecondaire::class);
   
   $uneffet=$repository->find($id);
   return $this->render('effetsecondaire/effetAvecId.html.twig', [
    'leseffetsecondaires' => $uneffet,
    ]);
}
#[Route('/formulaire_add_effet' , name: 'formulaire_add_effet')]
    public function formulaire_ajouteffet(ManagerRegistry $doctrine , Request $request):Response {
        $em=$doctrine->getManager();
        $Effetsecondaire=new Effetsecondaire();
        $form =$this->createForm(EffetsecondaireType::class,$Effetsecondaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $Effetsecondaire=$form->getData();
            $em->persist($Effetsecondaire);
            $em->flush();
            return $this->redirectToRoute('app_effetsecondaires');
        }
        return $this->render ('effetsecondaire/formulaire.html.twig',array(
            'form'=> $form->createView(),
        ));

        

        }
        #[Route('/formulaire_modif_effet/{id}' , name: 'formulaire_modif_effet')]
    public function formulaire_modifMed(ManagerRegistry $doctrine , $id,Request $request):Response {
        $em=$doctrine->getManager();
        $repository=$doctrine->getRepository(Effetsecondaire::class);
        $Effetsecondaire=$repository->find($id);
        $form =$this->createForm(EffetsecondaireType::class,$Effetsecondaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $Effetsecondaire=$form->getData();
            $em->persist($Effetsecondaire);
            $em->flush();
            return $this->redirectToRoute('app_effetsecondaires');
        }
        return $this->render ('effetsecondaire/formulaire.html.twig',array(
            'form'=> $form->createView(),
        ));

        

        }
        #[Route('/suppeffet/{id}', name: 'app_suppeffet')]
        public function Suppeffet(ManagerRegistry $doctrine,$id): Response
        {
           $repository=$doctrine->getRepository(Effetsecondaire::class);
           // Récupération de tous les adhérents
           $Effetsecondaire=$repository->find($id);
           $em=$doctrine->getManager();
           $em->remove($Effetsecondaire);
           $em->flush();
           return $this->redirectToRoute('app_effetsecondaires');
        }
}