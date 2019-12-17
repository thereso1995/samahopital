<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\DateType ;
use App\Entity\Medecin;
use App\Entity\Service;
use App\Entity\Specialite;
use App\Entity\ServiceRepository;
use App\Entity\SpecialiteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class MedecinType extends AbstractType
{
    
    
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('nom')
            ->add('prenom')
            -> add ( 'datenaiss' , DateType :: class , [
                // renders it as a single text box
                'widget' => 'single_text' ,
            ])
            ->add('tel')
            ->add('email')
            ->add('service',EntityType::class,[
                'class'=>Service::class,
                'choice_label'=>"libelle",
            ])
            
            
            ->add('specialite',EntityType::class,[
                'class'=>Specialite::class,
                'choice_label'=>"libelle",
                'multiple'=>true,
                'by_reference'=>false,
            ])
            ->add('save',SubmitType::class)
        ;}
    

        public function configureOptions (OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Medecin::class,
            ]);
        }


    
   
  
    

   
    }



