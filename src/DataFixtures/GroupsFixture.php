<?php

namespace App\DataFixtures;

use App\Entity\GroupsMedicModel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GroupsFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $group = new GroupsMedicModel();
        $group->setName('Nouveaux nés');
        $manager->persist($group);

        $group2 = new GroupsMedicModel();
        $group2->setName('Enfants');
        $manager->persist($group2);

        $group3 = new GroupsMedicModel();
        $group3->setName('Adultes');
        $manager->persist($group3);

        $group3b = new GroupsMedicModel();
        $group3b->setName('Adultes et efants');
        $manager->persist($group3b);

        $group4 = new GroupsMedicModel();
        $group4->setName('Tout public');
        $manager->persist($group4);


        $manager->flush();
    }
}
