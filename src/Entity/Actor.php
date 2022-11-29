<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $imagePath = null;

    #[ORM\OneToMany(mappedBy: 'Actorid', targetEntity: Rating::class)]
    private Collection $Rating;

    #[ORM\OneToMany(mappedBy: 'actorID', targetEntity: Movieactor::class)]
    private Collection $movieID;


    public function __construct()
    {
        $this->Rating = new ArrayCollection();
        $this->MovieID = new ArrayCollection();
        $this->movieID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRating(): Collection
    {
        return $this->Rating;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->Rating->contains($rating)) {
            $this->Rating->add($rating);
            $rating->setActorid($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->Rating->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getActorid() === $this) {
                $rating->setActorid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Movieactor>
     */
    public function getMovieID(): Collection
    {
        return $this->movieID;
    }

    public function addMovieID(Movieactor $movieID): self
    {
        if (!$this->movieID->contains($movieID)) {
            $this->movieID->add($movieID);
            $movieID->setActorID($this);
        }

        return $this;
    }

    public function removeMovieID(Movieactor $movieID): self
    {
        if ($this->movieID->removeElement($movieID)) {
            // set the owning side to null (unless already changed)
            if ($movieID->getActorID() === $this) {
                $movieID->setActorID(null);
            }
        }

        return $this;
    }

  
    
}
