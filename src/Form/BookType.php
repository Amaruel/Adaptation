<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Publisher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('ISBN', IntegerType::class, [
                'label' => 'ISBN'
            ])
            ->add('pagination', IntegerType::class, [
                'label' => 'Nombre de pages'
            ])
            ->add('publicationDate', DateType::class, [
                'label' => 'Date de publication'
            ])
            ->add('abstract', TextareaType::class,[
                'label' => 'Résumé'
            ])
            ->add('bookcoverfile', FileType::class, [
                'label' => 'Couverture'
            ])

            ->add('publisher', EntityType::class, [
                'class' => Publisher::class,
                'label' => 'Editeur',
                'choice_label' => 'name'
            ])
/*
            ->add('authors', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'name'
            ])

            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'label' => 'Genre',
                'choice_label' => 'name'
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
