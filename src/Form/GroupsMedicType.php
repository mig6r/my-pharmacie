<?php

namespace App\Form;

use App\Entity\Famille;
use App\Entity\GroupsMedic;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupsMedicType extends AbstractType
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
            ->add('Name')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupsMedic::class,
        ])->setRequired('famille');
    }
}
