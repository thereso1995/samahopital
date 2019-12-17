<?php

namespace App\Controller;


use App\Entity\Medecin;
use App\Entity\Service;
use App\Form\MedecinType;
use App\Entity\Specialite;
use App\generator\matriculeGenerator;
use App\Repository\MedecinRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class MedecinController extends AbstractController
{
    /**
     * @Route("/medecin", name="medecinshow")
     */
    public function showMedecin(MedecinRepository $medRepos)
    {
        $medecins = $medRepos -> findAll();
        return $this->render('medecin/index.html.twig', [
            'medecins' => $medecins
        ]);
    }
     /**
     * @Route("/medecin/new", name="medecin_new")
     */
    public function new(Request $request,matriculeGenerator $mat_generator,MedecinRepository $medRepo)
    {
        

        $medecin = new Medecin();

        $form =$this->createForm(MedecinType::class, $medecin);
        $form ->handleRequest($request);
        if($form ->isSubmitted() && $form->isValid()){

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist ($medecin);
            $entityManager->flush();
            return $this->redirectToRoute('medecinshow');
        }
                        

        return $this->render('medecin/new.html.twig', [
            'form' => $form->createView(),
            'medecin' =>$medRepo->findAll(),
            'matricule' =>$mat_generator->generate()
            
        ]);
    }
}


