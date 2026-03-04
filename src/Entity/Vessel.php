<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'vessels')]
class Vessel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $imo = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $flag = null;

    public function getId(): ?int { return $this->id; }

    public function getImo(): ?string { return $this->imo; }
    public function setImo(string $imo): static { $this->imo = $imo; return $this; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getFlag(): ?string { return $this->flag; }
    public function setFlag(string $flag): static { $this->flag = $flag; return $this; }
}