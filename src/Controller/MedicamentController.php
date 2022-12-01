<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Medicament;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MedicamentType;

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
public function AfficherLeMedicament(ManagerRegistry $doctrine,$id): Response
{
   $repository=$doctrine->getRepository(Medicament::class);
   
   $unMedicament=$repository->find($id);
   return $this->render('medicament/medicamentAvecId.html.twig', [
    'medicament' => $unMedicament,
    ]);
}
#[Route('/formulaire_add_medicament' , name: 'formulaire_add_medicament')]
    public function formulaire_ajoutMed(ManagerRegistry $doctrine , Request $request):Response {
        $em=$doctrine->getManager();
        $Medicament=new Medicament();
        $form =$this->createForm(MedicamentType::class,$Medicament);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $Medicament=$form->getData();
            $em->persist($Medicament);
            $em->flush();
            return $this->redirectToRoute('app_medicament');
        }
        return $this->render ('medicament/formulaire.html.twig',array(
            'form'=> $form->createView(),
        ));

        

        }
        #[Route('/formulaire_modif_medicament/{id}' , name: 'formulaire_modif_medicament')]
    public function formulaire_modifMed(ManagerRegistry $doctrine , $id,Request $request):Response {
        $em=$doctrine->getManager();
        $repository=$doctrine->getRepository(Medicament::class);
        $Medicament=$repository->find($id);
        $form =$this->createForm(MedicamentType::class,$Medicament);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $Medicament=$form->getData();
            $em->persist($Medicament);
            $em->flush();
            return $this->redirectToRoute('app_medicament');
        }
        return $this->render ('medicament/formulaire.html.twig',array(
            'form'=> $form->createView(),
        ));

        

        }
        #[Route('/suppMedicament/{id}', name: 'app_suppMedicament')]
        public function SuppMedicament(ManagerRegistry $doctrine,$id): Response
        {
           $repository=$doctrine->getRepository(Medicament::class);
           // Récupération de tous les adhérents
           $Medicament=$repository->find($id);
           $em=$doctrine->getManager();
           $em->remove($Medicament);
           $em->flush();
           return $this->redirectToRoute('app_medicament');
        }


}
