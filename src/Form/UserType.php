<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',
                TextType::class,[
                'required' => true,
                    'label' => 'Name',
                ])
            ->add('surname',
                TextType::class,[
                    'required' => true,
                    'label' => 'Surname',
                    ])
            ->add('username', TextType::class,[
                'required' => true,
                'label' => 'Username',
                ])
            ->add('password',  PasswordType::class, [
                'hash_property_path' => 'password',
                'mapped' => false,
                'label' => 'Password',
                ])
            ->add('age', IntegerType::class, [
                'mapped' => false,
                'label' => 'Age',
            ])
            ->add('type', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Lecturer'=>'Lecturer',
                    'Student'=>'Student',
                ],
                'mapped'=>false,
                'expanded'=>false,
                'multiple'=>false,
                'label' => 'Type',
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'mapped' => false,
                'label' => 'Email',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
