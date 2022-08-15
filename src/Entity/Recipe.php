<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]

class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    #[Assert\NotNull()]
    #[Assert\Length(min:3,max:50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\NotNull()]
    #[Assert\GreaterThan(0)]
    private ?int $nbpeople = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Assert\NotNull()]
    #[Assert\LessThan(5)]
    private ?int $difficulty = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\NotNull()]
    #[Assert\Length(min:3,max:300)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank()]
    #[Assert\NotNull()]
    #[Assert\GreaterThan(0)]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $isFavorite = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Engredient::class)]
    private Collection $engredient;

    public function __construct()
    {
        $this->engredient = new ArrayCollection();
        $this->createdAt=new \DateTimeImmutable();
        $this->updatedAt=new \DateTimeImmutable();
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

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getNbpeople(): ?int
    {
        return $this->nbpeople;
    }

    public function setNbpeople(int $nbpeople): self
    {
        $this->nbpeople = $nbpeople;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isIsFavorite(): ?bool
    {
        return $this->isFavorite;
    }

    public function setIsFavorite(bool $isFavorite): self
    {
        $this->isFavorite = $isFavorite;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
    #[ORM\PrePersist()]
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, engredient>
     */
    public function getEngredient(): Collection
    {
        return $this->engredient;
    }

    public function addEngredient(Engredient $engredient): self
    {
        if (!$this->engredient->contains($engredient)) {
            $this->engredient->add($engredient);
        }

        return $this;
    }

    public function removeEngredient(Engredient $engredient): self
    {
        $this->engredient->removeElement($engredient);

        return $this;
    }
}
