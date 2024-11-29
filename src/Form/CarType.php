<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du véhicule'])
            ->add('description', TextType::class)
            ->add('price_month', IntegerType::class, [
                'rounding_mode' => 2,
                'label' => 'Prix journalier',
            ])
            ->add('price_day', IntegerType::class, [
                'rounding_mode' => 2,
            ])
            ->add('seats', ChoiceType::class, [
                'label' => 'Nombre de places',
                'choices' => range(2, 8, 3),
                'choice_label' => function ($choice) {
                    return $choice;
                }
            ])
            ->add('gearbox', ChoiceType::class, [
                'label' => 'Boîte de vitesse',
                'choices' => [
                    'Manuelle' => true,
                    'Automatique' => false,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
