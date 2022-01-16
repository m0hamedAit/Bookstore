<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AuteurFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i=0;$i<20;$i++){
            $auteur = new Auteur();
            $auteur->setNomPrenom($faker->unique()->name());
            $auteur->setSexe($faker->randomElement(['M','F']));
            $auteur->setNationalite($faker->randomElement(["American",'Spanish','French','Australian',"Canadian","German"]));
            $auteur->setDateDeNaissance(new \DateTime($faker->date('Y-m-d',"2000-01-01")));
            

            $manager->persist($auteur);
        }
        
        $manager->flush();
    }
}
