<?php

namespace TBCD\Webshop\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\MappedSuperclass]
class Article
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    protected ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(allowNull: true)]
    protected ?string $description = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\NotNull]
    protected ?float $price = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive]
    protected ?int $quantityMax = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive]
    protected ?int $weight = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQuantityMax(): ?int
    {
        return $this->quantityMax;
    }

    public function setQuantityMax(?int $quantityMax): void
    {
        $this->quantityMax = $quantityMax;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): void
    {
        $this->weight = $weight;
    }
}
