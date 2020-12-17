<?php

namespace App\Form;

use App\Entity\Appointment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('theme')
            ->add('level',ChoiceType::class,[
                'choices' => [
                    'débutant' => 'débutant',
                    'intermédiaire' => 'intermédiaire',
                    'confirmé' => 'confirmé'
                ]
            ])
            ->add('date', DateType::class,[
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'
            ])
            ->add('startHour',TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('endHour', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('Valider', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
