<?php

/*
 * This file is part of the tbcd/cas project.
 *
 * (c) Thomas Beauchataud <thomas.beauchataud@yahoo.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Thomas Beauchataud
 * From 17/11/2024
 */

namespace TBCD\Webshop\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\MappedSuperclass]
class Shipment
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?DateTimeInterface $creationDate;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $reference = null;

    #[ORM\Embedded]
    #[Assert\Valid]
    #[Assert\NotNull]
    private ?ContactAddress $origin = null;

    #[ORM\Embedded]
    #[Assert\Valid]
    #[Assert\NotNull]
    private ?ContactAddress $destination = null;

    public function __construct()
    {
        $this->creationDate = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestination(): ?ContactAddress
    {
        return $this->destination;
    }

    public function setDestination(?ContactAddress $destination): void
    {
        $this->destination = $destination;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    public function getOrigin(): ?ContactAddress
    {
        return $this->origin;
    }

    public function setOrigin(?ContactAddress $origin): void
    {
        $this->origin = $origin;
    }

    public function getCreationDate(): ?DateTimeInterface
    {
        return $this->creationDate;
    }
}