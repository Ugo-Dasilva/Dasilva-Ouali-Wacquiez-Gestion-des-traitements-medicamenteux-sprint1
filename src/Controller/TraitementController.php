<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Traitement;
use App\Entity\Sejour;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/ajoutTraitement', name: 'app_ajoutTraitement')]
    public function AjouterUnTraitement(ManagerRegistry $doctrine, Request $request): Response
    {
        $em=$doctrine->getManager();
        $traitement=new Traitement();
        $form = $this->createFormBuilder($traitement)
        ->add('datedebut',DateType::class, array('label'=>'Date de début du traitement : '))
        ->add('datefin',DateType::class, array('label'=>'Date de fin du traitement : '))
        ->add('sejour',EntityType::class,array('class'=>Sejour::class,'choice_label'=>'id'))
        ->add('save', SubmitType::class, array('label' => 'Enregistrer le traitement'))
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $traitement = $form->getData();
            $em->persist($traitement);
            $em->flush();
            // redirection vers la liste des traitements
            return $this->redirectToRoute('app_traitements');
        }
        else{
            return $this->render('traitement/ajoutTraitement.html.twig', array(
            'form' => $form->createView(),));
        }
    }

    
    #[Route('/modifTraitement/{id}', name: 'app_modifTraitement')]
    public function ModifierUnTraitement(ManagerRegistry $doctrine,Request $request, $id): Response
    {
    $repository=$doctrine->getRepository(Traitement::class);
    $em=$doctrine->getManager();
    $traitement=$repository->find($id);
    $form = $this->createFormBuilder($traitement)
    ->add('datedebut',DateType::class, array('label'=>'Date de début du traitement : '))
    ->add('datefin',DateType::class, array('label'=>'Date de fin du traitement : '))
    ->add('sejour',EntityType::class,array('class'=>Sejour::class,'choice_label'=>'id'))
    ->add('save', SubmitType::class, array('label' => 'Modifier le traitement'))
    ->getForm();
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $traitement = $form->getData();
        $em->persist($traitement);
        $em->flush();
        // redirection vers la liste des adhérents
        return $this->redirectToRoute('app_traitements');
    }
    else{
        return $this->render('traitement/modifTraitement.html.twig', array(
    'form' => $form->createView(),));
    }
    }

    #[Route('/suppTraitement/{id}', name: 'app_suppTraitement')]
        public function indexSuppAdherent(ManagerRegistry $doctrine,$id): Response
        {
           $repository=$doctrine->getRepository(Traitement::class);
           // Récupération de tous les adhérents
           $unTraitement=$repository->find($id);
           $em=$doctrine->getManager();
           $em->remove($unTraitement);
           $em->flush();
           return $this->redirectToRoute('app_traitements');
        }

}
