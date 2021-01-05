<?php

namespace App\Form;

use App\Entity\Article;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'label' => "Titre de l'article",
            ])
            ->add('description', TextType::class, [
                'label' => "Résumé de l'article"
            ])
            ->add('content', TextType::class, [
                'label' => "Contenu"
            ])
            ->add('creationDate', DateType::class,[
                'label' => "Date de création",
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('published', CheckboxType::class,[
                'label' => "(Cochez la case pour publié cette article)"
            ] )
            ->add('Filename', FileType::class,[
                'label' => 'Joindre votre(ou vos) image(s)',
//                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
