<?php

namespace App\Controller;


use App\Entity\Commande;
use App\Form\CommandeType;

use App\Repository\CommandeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Stripe\Stripe;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
   
    #[Route('/home', name: 'front')]
    public function afficherFront (): Response
    {
      
        return $this->render('Front/home.html.twig', 
            
    );
}

    
    #[Route('/commande', name: 'app_commande')]
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    #[Route('/list', name: 'list_commande')]
    public function afficher(ManagerRegistry $doctrine): Response
    {
        $repository= $doctrine->getRepository(Commande::class); 

        $Commande=$repository->findall();
        return $this->render('commande/list.html.twig', [
            'commande' => $Commande,
        ]);


    }
    
    #[Route('/supp/{id}', name: 's')]
   
    public function supprimer($id,request $request ): Response
    {
        
        $Commande=$this->getDoctrine()->getRepository(Commande::class)->find($id);
        $em= $this->getDoctrine()->getManager(); 
       $em->remove($Commande);
       $em->flush();
        return $this->redirectToRoute('list_commande');


    }


    #[Route('/add', name: 'a')]

    public function ajouter(Request $request)
    {
        $Commande= new Commande();
        $form=$this->createForm(CommandeType::class,$Commande);
        $form->add('Ajouter', SubmitType::class);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid())
        {
         $em=$this->getdoctrine()->getManager();
         $em->persist($Commande);
         $em->flush();

         return $this->redirectToRoute('list_commande');

        }
        return $this->render('commande/Add.html.twig',[

            'form'=>$form->createView()
        ]);


    }



    #[Route('/up/{id}', name: 'u')]

    public function update(CommandeRepository $repository,Request $request ,$id)
    {
        $Commande=$repository->find($id);
        $form=$this->createForm(CommandeType::class,$Commande);
        $form->add('modifier', SubmitType::class);
        $form->handleRequest($request);


        if( $form->isSubmitted() && $form->isValid())
        {
         $em=$this->getdoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('list_commande');

        }
        return $this->render('Commande/update.html.twig',
        [
            'f'=>$form->createView()
        ]);
    }
    

}
