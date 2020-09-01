<?php

namespace App\Form;

use App\Entity\Advantage;
use App\Entity\Character;
use App\Entity\CharacterSkills;
use App\Entity\CharSkills;
use App\Entity\Culture;
use App\Entity\Disadvantage;
use App\Entity\Generalspecialskill;
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
                'choice_label' => 'name'
            ])
            ->add('culture', EntityType::class, [
                'class' => Culture::class,
                'choice_label' => 'name'
            ])
            ->add('profession', EntityType::class, [
                'class' => Profession::class,
                'choice_label' => 'name'
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

            ->add('lifeenergy')
            ->add('lifeenergybonus')
            ->add('lifeenergypurchase')
            ->add('lifeenergymax')
            ->add('astralenergy')
            ->add('astralenergybonus')
            ->add('astralenergypurchase')
            ->add('astralenergymax')
            ->add('karmaenergy')
            ->add('karmaenergybonus')
            ->add('karmaenergypurchase')
            ->add('karmaenergymax')
            ->add('soulpower')
            ->add('soulpowerbonus')
            ->add('soulpowermax')
            ->add('toughness')
            ->add('toughnessbonus')
            ->add('toughnessmax')
            ->add('dodge')
            ->add('dodgebonus')
            ->add('dodgemax')
            ->add('initiative')
            ->add('initiativebonus')
            ->add('initiativemax')
            ->add('speed')
            ->add('speedbonus')
            ->add('speedmax')
            ->add('fatepoints')
            ->add('fatepointsbonus')
            ->add('fatepointsmax')
            ->add('fatepointscurrent')


            ->add('advantages', EntityType::class, [
                'class' => Advantage::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('disadvantages', EntityType::class, [
                'class' => Disadvantage::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('generalspecialskills', EntityType::class, [
                'class' => Generalspecialskill::class,
                'choice_label' => 'skillname',
                'multiple' => true
            ])
            ->add('annotation')

            ->add('charskills')

            ->add('submit', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
