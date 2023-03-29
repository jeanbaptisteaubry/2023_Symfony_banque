<?php

namespace App\Form;

use App\Entity\Compte;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Compte1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numCompte', TextType::class, [
                'label' => 'Numéro de compte',
                'attr' => ['maxlength' => 10]
            ])
            ->add('iban', TextType::class, [
                'label' => 'Iban',
                'attr' => ['maxlength' => 27,'minlength' => 27]
            ])
            ->add('titre')
            ->add('codeBanque')
            ->add('client', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'username',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
