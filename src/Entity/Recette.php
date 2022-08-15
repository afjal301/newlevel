<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $engredient = null;

    #[ORM\Column(length: 255)]
    private ?string $delicious = null;

    #[ORM\Column]
    private ?bool $favorite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEngredient(): ?string
    {
        return $this->engredient;
    }

    public function setEngredient(string $engredient): self
    {
        $this->engredient = $engredient;

        return $this;
    }

    public function getDelicious(): ?string
    {
        return $this->delicious;
    }

    public function setDelicious(string $delicious): self
    {
        $this->delicious = $delicious;

        return $this;
    }

    public function isFavorite(): ?bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): self
    {
        $this->favorite = $favorite;

        return $this;
    }
}
