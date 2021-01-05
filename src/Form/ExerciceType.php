<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Exercise;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'exercice"
            ])
            ->add('description', TextType::class, [
        'label' => "Description de l'exercice"
    ])
            ->add('level', ChoiceType::class,[
                    'label' => "Niveau de difficulté",
                'choices' => [
                    'débutant' => 'débutant',
                    'intermédiaire' => 'intermédiaire',
                    'confirmé' => 'confirmé'
                ]
            ])
            ->add('category',EntityType::class,[
                'label' => "Catégorie",
                "class"=> Category::class,
                "choice_label"=>"Category"
            ])
            ->add('Filename', FileType::class,[
                'label' => 'Joindre votre(ou vos) image(s)',
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
