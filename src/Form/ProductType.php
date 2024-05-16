<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder'=> 'Sweatshirt'
                ]
            ])
            ->add('price', null, [
                'label' => 'Prix',
                'attr' => [
                    'placeholder'=> 'Prix'
                ]])
            ->add('stock_xs', null, [
                'label' => 'Stock XS'
                ])
            ->add('stock_s', null, [
                'label' => 'Stock S'
                ])
            ->add('stock_m', null, [
                'label' => 'Stock M'
                ])
            ->add('stock_l', null, [
                'label' => 'Stock L'
                ])
            ->add('stock_xl', null, [
                'label' => 'Stock XL'
                ])
            ->add('homepage', null, [
                'label' => 'Page d\'accueil'
                ])
            ->add('img_name')
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
