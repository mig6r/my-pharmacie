<?php

namespace App\Form;

use App\Entity\MedicamentFilter;
use App\Entity\Symptome;
use App\Repository\CatMedicamentsRepository;
use App\Repository\GroupsMedicRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentFilterType extends AbstractType
{
    private $gm;
    private $cm;

    public function __construct(GroupsMedicRepository $gm, CatMedicamentsRepository $cm)
    {
        $this->gm = $gm;
        $this->cm = $cm;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('catMedic', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'choices' => $this->cm->getChoices(),
                'placeholder' => 'Toutes les catégories'


            ])
            ->add('groupMedic', ChoiceType::class, [
        'required' => false,
        'label' => false,
        'choices' => $this->gm->getChoices(),
        'placeholder' => 'Tout les groupes'

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
