<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
        'label' => 'Prénom'
    ])
            ->add('lastName', TextType::class,[
        'label' => 'Nom de famille'
    ])
            ->add('birthDate', DateType::class,[
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'])
            ->add('email', EmailType::class, [
                'label' => "Entrez votre email"
            ])
//            ->add('roles')
            ->add('password', PasswordType::class,[
                'label' => 'Mot de passe',
            ])
            ->add('adress', TextType::class,[
                'label' => 'Adresse'
            ])
            ->add('zipcode', IntegerType::class,[
                'label' => 'code postale'
            ] )
            ->add('city',TextType::class,[
                'label' => 'Votre ville'
            ])
            ->add('phoneNumber', IntegerType::class,[
                'label' => 'numéro de telephone'
            ])
            ->add("inscription", SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
