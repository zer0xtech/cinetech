<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le titre est obligatoire.')]
    #[Assert\Length(min: 2, max: 255, minMessage: 'Minimum {{ limit }} caractères.')]
    private ?string $Titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Synopsis = null;

    #[ORM\Column]
    #[Assert\Positive(message: 'La durée doit etre supérieure à 0.')]
    private ?int $Duree = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull(message: 'Date de sortie obligatoire.')]
    private ?\DateTime $dateSortie = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min: 0, max: 5, notInRangeMessage: 'La note doit se situer entre {{ min }} et {{ max }}.')]
    private ?float $notePresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $affiche = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $genre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->Synopsis;
    }

    public function setSynopsis(?string $Synopsis): static
    {
        $this->Synopsis = $Synopsis;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->Duree;
    }

    public function setDuree(int $Duree): static
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getDateSortie(): ?\DateTime
    {
        return $this->dateSortie;
    }


    public function setDateSortie(\DateTime $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getNotePresse(): ?float
    {
        return $this->notePresse;
    }

    public function setNotePresse(?float $notePresse): static
    {
        $this->notePresse = $notePresse;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(?string $affiche): static
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getGenre(): ?Category
    {
        return $this->genre;
    }

    public function setGenre(?Category $genre): static
    {
        $this->genre = $genre;

        return $this;
    }
}
