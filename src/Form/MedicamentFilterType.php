<?php

namespace App\Form;

use App\Entity\CatMedicaments;
use App\Entity\GroupsMedic;
use App\Entity\MedicamentFilter;
use App\Entity\Symptome;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentFilterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('catMedic', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => CatMedicaments::class,
                'choice_label' => 'name',
                'placeholder' => 'Catégorie'
            ])

            ->add('groupMedic', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => GroupsMedic::class,
                'choice_label' => 'name',
                'placeholder' => 'Public visé'
            ])

        ->add('symptomes', EntityType::class, [
            'required' => false,
            'label' => false,
            'class' => Symptome::class,
            'choice_label' => 'name',
            'multiple' => true,
            'placeholder' => 'Symptomes'

    ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MedicamentFilter::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
