<?php

namespace App\Form;

use App\Entity\Article;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'label' => "Titre de l'article",
            ])
            ->add('description', TextareaType::class, [
                'label' => "Résumé de l'article",
                'required' => false
            ])
            ->add('content', TextareaType::class, [
                'label' => "Contenu",
                'required' => false
            ])
            ->add('creationDate', DateType::class,[
                'label' => "Date de création",
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('published', CheckboxType::class,[
                'label' => "(Cochez la case pour publié cette article)",
                'required' => false
            ] )
            ->add('Filename', FileType::class,[
                'label' => 'Joindre votre(ou vos) image(s)',
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new All([
                        'constraints' => [
                            new File([
                                'maxSize' => '1024k',
                                'mimeTypesMessage' => 'Veuillez choisir une image au format jpg, svg ou png',
                                'mimeTypes' => [
                                    'image/jpeg',
                                    'image/png',
                                    'image/svg'
                                ]
                            ]),
                        ],
                    ]),
                ]
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
