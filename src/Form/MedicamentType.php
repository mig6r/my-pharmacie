<?php

namespace App\Form;

use App\Entity\CatMedicaments;
use App\Entity\Famille;
use App\Entity\GroupsMedic;
use App\Entity\Medicament;
use App\Entity\Symptome;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;


class MedicamentType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $famille = $options['famille'];
        $builder
            /*
            ->add('famille', EntityType::class, [
                'class' => Famille::class,
                'query_builder' => function (EntityRepository $er ) use ($famille) {
                    return $er->createQueryBuilder('u')
                        ->where('u.id = :famille')
                        ->setParameter('famille', $famille);

                },
                'choice_label' => 'name'

            ])
            */
            ->add('name')
            ->add('description')
            //->add('notice', FileType::class)


            //->add('picture', FileType::class)
                ->add('imageFile', FileType::class, [
                  'required' => false
            ])
            /*
            ->add('famille', HiddenType::class, [
                    'data' => $options['famille'],
                ]
            )*/

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
            ->add('catMedicament', EntityType::class, [
                'class' => CatMedicaments::class,
                'query_builder' => function (EntityRepository $er ) use ($famille) {
                    return $er->createQueryBuilder('u')
                        ->where('u.famille = :famille')
                        ->setParameter('famille', $famille);
                },

                'placeholder' => '',
                'choice_label' => 'name',
                'required' => false

            ])

            ->add('GroupMedicament', EntityType::class, [
                'class' => GroupsMedic::class,
                'query_builder' => function (EntityRepository $er ) use ($famille) {
                    return $er->createQueryBuilder('g')
                        ->where('g.famille = :famille')
                        ->setParameter('famille', $famille);
                },
                'choice_label' => 'name',
                'placeholder' => '',
                'required' => false
            ])

            ->add('symptomes', EntityType::class, [
                'class' => Symptome::class,
                'query_builder' => function (EntityRepository $er ) use ($famille) {
                    return $er->createQueryBuilder('u')
                        ->where('u.famille = :famille')
                        ->setParameter('famille', $famille);
                },
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
            'translation_domain' => 'forms'
        ])->setRequired('famille');
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
