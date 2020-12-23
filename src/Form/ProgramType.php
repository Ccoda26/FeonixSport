<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title')
            ->add('Description')
            ->add('Price')
            ->add('level',ChoiceType::class,[
                'choices' => [
                    'débutant' => 'débutant',
                    'intermédiaire' => 'intermédiaire',
                    'confirmé' => 'confirmé'
                ]
            ])
            ->add('category',EntityType::class,[
                    "class"=> Category::class,
                    "choice_label"=>"Category"
            ])
            ->add('published')
            ->add('Filename', FileType::class,[
                'label' => 'Uploadez votre image',
//                'label' => false,
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
