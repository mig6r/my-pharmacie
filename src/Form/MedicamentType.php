<?php

namespace App\Form;

use App\Entity\GroupsMedic;
use App\Entity\Medicament;
use App\Repository\GroupsMedicRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MedicamentType extends AbstractType
{
    private $gm;

    public function __construct(GroupsMedicRepository $gm)
    {
        $this->gm = $gm;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            //->add('notice', FileType::class)


            //->add('picture', FileType::class)
               ->add ('id_group', ChoiceType::class, [
                    'choices' => $this->gm->toChoices()
            ])
          /* ->add('id_group', EntityType::class, [
                'class' => GroupsMedic::class,
                'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('g')
                    ->orderBy('g.Name', 'ASC');
                   // ->getQuery()
                       // ->getResult();
                },
          'choice_label' => 'name',
            ])*/
            ->add('enable')
            ->add('commentaires')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
            'translation_domain' => 'forms'
        ]);
    }

    public function getTypes()
    {
        $types = Medicament::TYPES;
       sort ($types);

       /* $output = [];
        foreach ($types  as $key => $value)
        {
            $output[$value] = $key;
        }*/
        return array_flip($types);
    }
}
