<?php

namespace App\Form;

use App\Entity\Locations;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $family = $options['family'];
        $builder
            ->add('name');

        //Dans le controller on passe lock à true si l'emplacement est le parent d'autres emplacement
        //on affiche alors seulement le champs si lock est a false
        if ($options['lock'] == false) {

            // Dans le cas ou l'on modifie un emplacement, on ne veut pas qu'il puisse lui meme se définir comme parent
            // On ne l'affiche donc pas dans les choix possible de parent
            if ($builder->getData()->getId()) {

                $builder
                    ->add('parent', EntityType::class, [
                        'class' => Locations::class,
                        'choice_label' => 'name',
                        'required' => false,
                        'query_builder' => function (EntityRepository $er) use ($builder, $family) {
                            return $er->createQueryBuilder('l')
                                ->andWhere('l.id != :location')
                                ->setParameter('location', $builder->getData())
                                ->andWhere('l.famille = :famille')
                                ->setParameter('famille', $family)
                                ->andWhere('l.parent IS NULL');
                        }
                    ]);
            } else {
                $builder
                    ->add('parent', EntityType::class, [
                        'class' => Locations::class,
                        'choice_label' => 'name',
                        'required' => false,
                        'query_builder' => function (EntityRepository $er) use ($builder, $family) {
                            return $er->createQueryBuilder('l')
                                ->andWhere('l.parent IS NULL')
                                ->andWhere('l.famille = :famille')
                                ->setParameter('famille', $family);

                        }
                    ]);
            }
        }


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Locations::class,
            'translation_domain' => 'forms',
        ])->setRequired('lock')
            ->setRequired('family');
    }
}
