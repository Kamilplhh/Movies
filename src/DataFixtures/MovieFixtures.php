<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie(); 
        $movie->setTitle('The Dark Knight');
        $movie->setReleaseYear(2008);
        $movie->setDescription('Cool');
        $movie->setImagePath('https://cdn.pixabay.com/photo/2021/06/18/11/22/batman-6345897_960_720.jpg');
        $manager->persist($movie);

        $movie2 = new Movie(); 
        $movie2->setTitle('Avengers');
        $movie2->setReleaseYear(2012);
        $movie2->setDescription('Cool 2');
        $movie2->setImagePath('https://pixabay.com/illustrations/captain-america-avengers-marvel-5692937/');
        $manager->persist($movie2);

        $manager->flush();
    }
}
