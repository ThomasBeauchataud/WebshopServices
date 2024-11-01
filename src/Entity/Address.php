<?php

namespace TBCD\Webshop\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Symfony\Component\Validator\Constraints as Assert;

#[Embeddable]
class Address
{

    #[Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    protected ?string $firstname = null;

    #[Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    protected ?string $lastname = null;

    #[Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    protected ?string $street = null;

    #[Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    protected ?string $zipCode = null;

    #[Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    protected ?string $city = null;

    #[Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    protected ?string $country = null;

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }
}