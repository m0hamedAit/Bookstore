<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class GenreFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i=0;$i<10;$i++){
            $genre = new Genre();
            $genre->setNom($faker->unique()->randomElement(["Roman policier","Roman d aventures","Roman historique","Biographie","Autobiographie","Mémoire","Conte","Légende","Épopée","Nouvelle"]));
        
            $manager->persist($genre);
        }
        $manager->flush();
    }
}
