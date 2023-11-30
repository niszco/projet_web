<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Clothes;
use App\Entity\Size;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClothesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('price', IntegerType::class)
            ->add('description', TextType::class)
            ->add('color', TextType::class)
            ->add('image', TextType::class)
            ->add('brands', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
            ->add('size', EntityType::class, [
                'class' => Size::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Shoes'])
        ;
    }

        public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clothes::class,
        ]);
    }
}
