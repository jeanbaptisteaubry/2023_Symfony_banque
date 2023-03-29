<?php

namespace App\Form;

use App\Entity\Compte;
use App\Entity\VirementSortant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VirementSortant1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('ibanDestinataire', EntityType::class, [
                'class' => Compte::class,
                'choice_label' => 'iban',
            ])
            ->add('reference')
            ->add('compteEmetteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VirementSortant::class,
        ]);
    }
}
