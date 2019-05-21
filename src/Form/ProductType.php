<?php

namespace App\Form;

use App\Entity\Locations;
use App\Entity\Products;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $family = $options['famille'];
        $builder
            ->add('expire', DateType::class)
            ->add('location', EntityType::class, [
                'class' => Locations::class,
                'query_builder' => function (EntityRepository $er) use ($family) {
                    return $er->createQueryBuilder('l')
                        ->andWhere('l.parent IS NOT NULL')
                        ->andWhere('l.famille = :famille')
                        ->setParameter('famille', $family);
                },
                'choice_label' => function ($location) {
                    return $location->getParent()->getName() . " -> " . $location->getName();
                }

            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $product = $event->getData();
            $form = $event->getForm();

            if (null != $product->getId()) {

                if (-1 === $product->getInitialQuantity()){
                $form->add('state', ChoiceType::class, [
                    'choices' => $this->getChoices()
                ]);
            }else{
                    $form->add('quantity');
                }


            }
        });


    }

    private function getCHoices()
    {
        return array_flip(Products::STATES);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ])->setRequired('famille');
    }
}
