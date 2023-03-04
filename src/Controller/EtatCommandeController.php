<?php

namespace App\Controller;


use App\Entity\Commande;
use App\Entity\EtatCommande;
use App\Form\CommandeType;
use App\Form\EtatCommandeType;
use App\Repository\CommandeRepository;
use App\Repository\EtatCommandeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
class EtatCommandeController extends AbstractController
{
    #[Route('/etat/commande', name: 'app_etat_commande')]
    public function index(): Response
    {
        return $this->render('etat_commande/index.html.twig', [
            'controller_name' => 'EtatCommandeController',
        ]);
    }
    #[Route('/listEtat', name: 'listEtat')]
    public function afficher(ManagerRegistry $doctrine): Response
    {
        $repository= $doctrine->getRepository(EtatCommande::class); 

        $listEtat =$repository->findall();
        return $this->render('etat_commande/listEtat.html.twig', [
            'type' => $listEtat,
        ]);


    }

    #[Route('/suppEtat/{id}', name: 'supprimer')]
   
    public function supprimer($id,request $request ): Response
    {
        
        $listEtat=$this->getDoctrine()->getRepository(EtatCommande::class)->find($id);
        $em= $this->getDoctrine()->getManager(); 
       $em->remove($listEtat);
       $em->flush();
        return $this->redirectToRoute("listEtat");


    }



    #[Route('/addEtat', name: 'ajouter')]

    public function ajouter(Request $request)
    {
        $listEtat= new EtatCommande();
        $form=$this->createForm(EtatCommandeType::class,$listEtat);
        $form->add('Ajouter', SubmitType::class);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid())
        {
         $em=$this->getdoctrine()->getManager();
         $em->persist($listEtat);
         $em->flush();

         return $this->redirectToRoute('listEtat');

        }
        return $this->render('etat_commande/Add.html.twig',[

            'form'=>$form->createView()
        ]);


    }
    
    #[Route('upEtat/{id}', name: 'modifier')]

    public function update(EtatCommandeRepository $repository,Request $request ,$id)
    {
        $listEtat=$repository->find($id);
        $form=$this->createForm(EtatCommandeType::class,$listEtat);
        $form->add('modifier', SubmitType::class);
        $form->handleRequest($request);


        if( $form->isSubmitted() && $form->isValid())
        {
         $em=$this->getdoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('listEtat');

        }
        return $this->render('etat_commande/update.html.twig',
        [
            'f'=>$form->createView()
        ]);
    }
}
