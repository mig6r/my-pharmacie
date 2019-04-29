<?php

namespace App\Form;

use App\Entity\MedicamentFilter;
use App\Repository\CatMedicamentsRepository;
use App\Repository\GroupsMedicRepository;
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
                'label' => 'Catégorie',
                'choices' => $this->cm->getChoices(),
                'placeholder' => 'Toutes les catégories'


            ])
            ->add('groupMedic', ChoiceType::class, [
        'required' => false,
        'label' => 'Publique',
        'choices' => $this->gm->getChoices(),
        'placeholder' => 'Tout les groupes'

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
