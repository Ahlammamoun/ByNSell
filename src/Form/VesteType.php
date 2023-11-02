<?php

namespace App\Form;

use App\Entity\Veste;
use App\Entity\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class VesteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('taille')
            ->add('genre')
            ->add('picture')
            ->add('releaseDate', DateType::class, [
        
                'input' => 'datetime_immutable',
                'widget' => 'choice',
                'format' => 'yyyy-MM-dd',
                'years' => range(date('Y')-30, date('Y')),
                
            ])
            ->add('color')
            ->add('brand', EntityType::class, 

            [   'class' => Brand::class,
                'choice_label' => 'name',


            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Veste::class,
        ]);
    }
}
