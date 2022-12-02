<?php

namespace App\Controller;

use App\Entity\Indication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\IndicationType;

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

    #[Route('/indicationaffichage/{id}', name: 'app_affichage_indication')]
    public function Afficher(ManagerRegistry $doctrine,$id): Response
    {   
        $repository = $doctrine->getRepository(Indication::class);
        $lesIndications = $repository ->find($id);
        return $this->render('indication/index.html.twig', [
            'lesindications' => $lesIndications,
        ]);
    }
    #[Route('/indicationajout', name: 'app_ajout_indication')]
    public function ajoutIndication(ManagerRegistry $doctrine,Request $request): Response
    {   
        $em = $doctrine->getManager();
        $indication = new Indication();
        $form = $this->createForm(IndicationType::class,$indication);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $indication = $form->getData();
            $em->persist($indication);
            $em->flush();
            return $this->redirectToRoute("app_indication");
        }
        return $this->render('indication/formulaireajout.html.twig',array (      
        'form' => $form->createView(),
        ));
    }


    #[Route('/indicationmodification/{id}', name: 'app_modif_indication')]
    public function ModifierIndication(ManagerRegistry $doctrine,Request $request,$id): Response
    {   
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Indication::class);
        $indication = $repository ->find($id);
        $form = $this->createForm(IndicationType::class,$indication);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $indication = $form->getData();
            $em->persist($indication);
            $em->flush();
            return $this->redirectToRoute("app_indication");
        }
        return $this->render('indication/formulairemodif.html.twig',array (      
        'form' => $form->createView(),
        ));
    }

    #[Route('/indicationsupprimer/{id}', name: 'app_suppr_indication')]
    public function SupprimerIndication(ManagerRegistry $doctrine,Request $request,$id): Response
    {   
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Indication::class);
        $indication = $repository ->find($id);
        $em->remove($indication);
            $em->flush();
        return $this->render('indication/formulairesuppr.html.twig',[      
        'message' =>' Indication supprimé'
    ]);
    }


}