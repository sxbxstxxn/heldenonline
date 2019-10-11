<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => ['empty_data' => ' ']
            ])
            ->add('submit', SubmitType::class, [

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        //$resolver->setDefault('data_class', User::class);
        $resolver->setDefault('attr', ['novalidate' => 'novalidate']);
    }
}