<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'companies')]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique: true)]
    private ?string $taxId = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int { return $this->id; }

    public function getTaxId(): ?string { return $this->taxId; }
    public function setTaxId(string $taxId): static { $this->taxId = $taxId; return $this; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }
}