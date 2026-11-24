<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, ['label' => 'Titre du film (str)'])
            ->add('synopsis', TextType::class, ['label' => 'Synopsis du film (str)'])
            ->add('duree', NumberType::class, ['label' => 'Durée du film (int)'])
            ->add('dateSortie', DateType::class, ['label' => 'Sorti le'])
            ->add('notePresse', NumberType::class, ['label' => 'Note de la presse (entre 0 et 5)', 'attr' => ['min' => 0, 'max' => 5], 'required' => false])
            ->add('affiche', UrlType::class, ['label' => 'Affiche du film (URL) [Optionnel]'])
            ->add('slug', TextType::class, ['label' => 'Slug [Optionnel]', 'required' => false])
            ->add('genre', EntityType::class, ['class' => Category::class, 'choice_label' => 'name', 'label' => 'Catégorie',]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
