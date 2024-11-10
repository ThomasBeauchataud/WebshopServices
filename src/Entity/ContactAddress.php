<?php

namespace TBCD\Webshop\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Symfony\Component\Validator\Constraints as Assert;

#[Embeddable]
class ContactAddress extends Address
{

    #[Column(length: 255, nullable: true)]
    #[Assert\Email]
    protected ?string $email = null;

    #[Column(length: 255, nullable: true)]
    #[Assert\NotBlank(allowNull: true)]
    protected ?string $phone = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}