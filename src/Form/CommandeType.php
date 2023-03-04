<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\EtatCommande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class CommandeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
     ->add('etatCommande',EntityType::class,['class'=>EtatCommande ::class,
      'choice_label'=>'type'])
  
            ->add('dateCommande');
            $builder->add('dateCommande', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ]);

                $builder->add('dateLivraison', DateType::class, [
                    'widget' => 'single_text', 
                    'format' => 'yyyy-MM-dd', 
                ])
            ->add('total')
            ->add('prixLivraison')





           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
