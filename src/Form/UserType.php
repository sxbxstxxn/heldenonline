<?php


namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'empty_data' => ''
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class
                //'options' => ['empty_data' => '']
            ])
            ->add('email', TextType::class, [
                'empty_data' => ''
            ])
            ->add('dateofbirth', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('picture', TextType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class, [

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', User::class);
        $resolver->setDefault('attr', ['novalidate' => 'novalidate']);
    }
}