<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actor = new Actor();
        $actor->setName('Christian Bale');
        $actor->setImagePath('https://i.iplsc.com/christian-bale/000G6EPX6RDKOPMW-C122-F4.jpg');
        $manager->persist($actor);

        $actor2 = new Actor();
        $actor2->setName('Robert Downey JR');
        $actor2->setImagePath('https://cdn.gracza.pl/galeria/mdb/o/437718390.jpg');
        $manager->persist($actor2);
        
        $actor3 = new Actor();
        $actor3->setName('Chris Evans');
        $actor3->setImagePath('https://biografia24.pl/wp-content/uploads/2022/10/Chris-Evans.jpg');
        $manager->persist($actor3);

        $manager->flush();

        $this->addReference('actor_1', $actor);
        $this->addReference('actor_2', $actor2);
        $this->addReference('actor_3', $actor3);

       
        

    }
}
