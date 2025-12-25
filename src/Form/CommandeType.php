<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Menu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('menu', EntityType::class, [
                'class' => Menu::class,
                'choice_label' => 'nom', // le champ affiché dans le select
                'placeholder' => 'Choisir un menu',
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text', // pratique pour les navigateurs modernes
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
