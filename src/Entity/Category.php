<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Category = null;

    #[ORM\OneToMany(mappedBy: 'CategoryID', targetEntity: Movie::class)]
    private Collection $MovieID;

    public function __construct()
    {
        $this->MovieID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function __toString() 
    {
        return (string) $this->id; 
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovieID(): Collection
    {
        return $this->MovieID;
    }

    public function addMovieID(Movie $movieID): self
    {
        if (!$this->MovieID->contains($movieID)) {
            $this->MovieID->add($movieID);
            $movieID->setCategoryID($this);
        }

        return $this;
    }

    public function removeMovieID(Movie $movieID): self
    {
        if ($this->MovieID->removeElement($movieID)) {
            // set the owning side to null (unless already changed)
            if ($movieID->getCategoryID() === $this) {
                $movieID->setCategoryID(null);
            }
        }

        return $this;
    }
}
