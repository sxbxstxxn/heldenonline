<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\Culture;
use App\Entity\Profession;
use App\Entity\Species;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('charname')

            ->add('species', EntityType::class, [
                'class' => Species::class,
                'choice_label' => 'speciesname'
            ])
            ->add('culture', EntityType::class, [
                'class' => Culture::class,
                'choice_label' => 'culturename'
            ])
            ->add('profession', EntityType::class, [
                'class' => Profession::class,
                'choice_label' => 'professionname'
            ])

            ->add('experiencelevel', ChoiceType::class, [
                'choices' => [
                    'Unerfahren' => 'Unerfahren',
                    'Durchschnittlich' => 'Durchschnittlich',
                    'Erfahren' => 'Erfahren',
                    'Kompetent' => 'Kompetent',
                    'Meisterlich' => 'Meisterlich',
                    'Brillant' => 'Brillant',
                    'Legendär' => 'Legendär',
                ],
            ])
            ->add('aptotal')
            ->add('apavailable')
            ->add('apspent')

            ->add('attributeMu')
            ->add('attributeKl')
            ->add('attributeIn')
            ->add('attributeCh')
            ->add('attributeFf')
            ->add('attributeGe')
            ->add('attributeKo')
            ->add('attributeKk')

            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'männlich' => 'männlich',
                    'weiblich' => 'weiblich',
                ],
            ])
            ->add('birthplace')
            ->add('birthdate')
            ->add('age')

            ->add('size')
            ->add('weight')
            ->add('haircolor')
            ->add('eyecolor')
            ->add('title')
            ->add('socialstatus', ChoiceType::class, [
                'choices' => [
                    'Unfrei' => 'Unfrei',
                    'Frei' => 'Frei',
                    'Niederadel' => 'Niederadel',
                    'Adel' => 'Adel',
                    'Hochadel' => 'Hochadel',
                ],
            ])
            ->add('family')
            ->add('characteristics')
            ->add('further')


            ->add('submit', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
