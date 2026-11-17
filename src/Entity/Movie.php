<?php

namespace App\Entity;

use App\Repository\MovieRepository;
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
    private ?string $Titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Synopsis = null;

    #[ORM\Column]
    private ?int $Durée = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateSortie = null;

    #[ORM\Column(nullable: true)]
    private ?float $notePresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $affiche = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

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

    public function getDurée(): ?int
    {
        return $this->Durée;
    }

    public function setDurée(int $Durée): static
    {
        $this->Durée = $Durée;

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
}
