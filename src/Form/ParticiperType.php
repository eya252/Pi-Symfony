<?php

namespace App\Form;

use App\Entity\Participer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ParticiperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbrePlace')
            ->add('emplacement', ChoiceType::class, [
                'choices'  => [
                    'VIP' => 'VIP',
                    '1ERE place' => '1ERE place',
                    '2eme place' => '2eme place',
                ],
            ]);


// ...


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participer::class,
        ]);
    }
}
