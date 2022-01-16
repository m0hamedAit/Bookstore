<?php

namespace App\DataFixtures;

use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LivreFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $auteurs = $manager->getRepository(Auteur::class)->findAll();
        $auteursIds = [];
        $genres = $manager->getRepository(Genre::class)->findAll();
        $genresIds = [];
        foreach ($auteurs as $auteur) {
            array_push($auteursIds, $auteur->getId());
        }
        foreach ($genres as $genre) {
            array_push($genresIds, $genre->getId());
        }
        for($i=0;$i<50;$i++){
            $aIds = array_rand($auteursIds, mt_rand(1, 3));
            if(is_integer($aIds)){
                $aIds = array($aIds);
            }
            $gIds = array_rand($genresIds, mt_rand(1, 3));
            if(is_integer($gIds)){
                $gIds = array($gIds);
            }

            $livre = new Livre();
            $livre->setIsbn($faker->unique()->isbn13());
            $livre->setTitle($faker->unique()->sentence());
            $livre->setNombrePages($faker->randomNumber(3, true));
            $livre->setDateDeParution($faker->dateTimeBetween('-121 year', '-10 days'));
            $livre->setNote($faker->numberBetween(0, 20));
            foreach ($aIds as $aId) {
                $auteur = $manager->getRepository(Auteur::class)->find($auteursIds[$aId]);
                $livre->addAuteur($auteur);
            }
            foreach ($gIds as $gId) {
                $genre = $manager->getRepository(Genre::class)->find($genresIds[$gId]);
                $livre->addGenre($genre);
            }

            $manager->persist($livre);
        }
        $manager->flush();
    }
}
