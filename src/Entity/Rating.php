<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Rating = null;

    #[ORM\ManyToOne(inversedBy: 'Rating')]
    private ?Actor $Actorid = null;

    #[ORM\ManyToOne(inversedBy: 'Rating')]
    private ?User $User = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->Rating;
    }

    public function setRating(?int $Rating): self
    {
        $this->Rating = $Rating;

        return $this;
    }

    public function getActorid(): ?Actor
    {
        return $this->Actorid;
    }

    public function setActorid(?Actor $Actorid): self
    {
        $this->Actorid = $Actorid;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }



   
}
