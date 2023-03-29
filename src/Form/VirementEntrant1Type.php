<?php

namespace App\Form;

use App\Entity\Compte;
use App\Entity\Utilisateur;
use App\Entity\VirementEntrant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VirementEntrant1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('montant')
            ->add('ibanEmetteur')
            ->add('reference')
            ->add('compteBeneficiaire', EntityType::class, [
                'class' => Compte::class,
                'choice_label' => 'iban',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VirementEntrant::class,
        ]);
    }
}
