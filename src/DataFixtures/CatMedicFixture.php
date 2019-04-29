<?php

namespace App\DataFixtures;

use App\Entity\CatMedicaments;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CatMedicFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {


        $cat = new CatMedicaments();
        $cat->setName('Allergologie');
        $manager->persist($cat);

        $cat2 = new CatMedicaments();
        $cat2->setName('Antalgique');
        $manager->persist($cat2);

        $cat3 = new CatMedicaments();
        $cat3->setName('Anti-inflammatoire');
        $manager->persist($cat3);

        $cat4 = new CatMedicaments();
        $cat4->setName('Cancérologie / hématologie');
        $manager->persist($cat4);

        $cat5 = new CatMedicaments();
        $cat5->setName('Cardiologie / angéiologie');
        $manager->persist($cat5);

        $cat6 = new CatMedicaments();
        $cat6->setName('Contraception');
        $manager->persist($cat6);

        $cat7 = new CatMedicaments();
        $cat7->setName('Dermatologie');
        $manager->persist($cat7);

        $cat8 = new CatMedicaments();
        $cat8->setName('Endocrinologie');
        $manager->persist($cat8);

        $cat9 = new CatMedicaments();
        $cat9->setName('Gastro-Entéo-Hépatologie');
        $manager->persist($cat9);

        $cat10 = new CatMedicaments();
        $cat10->setName('Gynécologie');
        $manager->persist($cat10);

        $cat11 = new CatMedicaments();
        $cat11->setName('Hémostase et sang');
        $manager->persist($cat11);

        $cat12 = new CatMedicaments();
        $cat12->setName('Immunologie');
        $manager->persist($cat12);

        $cat13 = new CatMedicaments();
        $cat13->setName('infectiologie');
        $manager->persist($cat13);

        $cat14 = new CatMedicaments();
        $cat14->setName('Métabolisme et nutrition');
        $manager->persist($cat14);

        $cat15 = new CatMedicaments();
        $cat15->setName('Neurologie-psychiatrie');
        $manager->persist($cat15);

        $cat16 = new CatMedicaments();
        $cat16->setName('Ophtalmologie');
        $manager->persist($cat16);

        $cat17 = new CatMedicaments();
        $cat17->setName('Oto-rhino-laryngologie');
        $manager->persist($cat17);

        $cat18 = new CatMedicaments();
        $cat18->setName('Pneumologie');
        $manager->persist($cat18);

        $cat19 = new CatMedicaments();
        $cat19->setName('Produits diagnostiques');
        $manager->persist($cat19);

        $cat20 = new CatMedicaments();
        $cat20->setName('Rhumatologie');
        $manager->persist($cat20);

        $cat21 = new CatMedicaments();
        $cat21->setName('Sang et dérivés');
        $manager->persist($cat21);

        $cat22 = new CatMedicaments();
        $cat22->setName('Homéopathie');
        $manager->persist($cat22);

        $cat23 = new CatMedicaments();
        $cat23->setName('Stomatologie');
        $manager->persist($cat23);

        $cat24 = new CatMedicaments();
        $cat24->setName('Toxicologie');
        $manager->persist($cat24);

        $cat25 = new CatMedicaments();
        $cat25->setName('Urologie néphrologie');
        $manager->persist($cat25);


        $manager->flush();
    }
}
