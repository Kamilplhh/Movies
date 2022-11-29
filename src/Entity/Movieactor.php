<?php

namespace App\Entity;

use App\Repository\MovieactorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieactorRepository::class)]
class Movieactor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'movieID')]
    private ?Actor $actorID = null;

    #[ORM\ManyToOne]
    private ?Movie $movieID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActorID(): ?Actor
    {
        return $this->actorID;
    }

    public function setActorID(?Actor $actorID): self
    {
        $this->actorID = $actorID;

        return $this;
    }

    public function getMovieID(): ?Movie
    {
        return $this->movieID;
    }

    public function setMovieID(?Movie $movieID): self
    {
        $this->movieID = $movieID;

        return $this;
    }
}
