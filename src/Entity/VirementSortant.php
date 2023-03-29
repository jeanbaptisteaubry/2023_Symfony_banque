<?php

namespace App\Entity;

use App\Repository\VirementSortantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VirementSortantRepository::class)]
class VirementSortant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 27)]
    private ?string $ibanDestinataire = null;

    #[ORM\ManyToOne(inversedBy: 'virementSortants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compte $compteEmetteur = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIbanDestinataire(): ?string
    {
        return $this->ibanDestinataire;
    }

    public function setIbanDestinataire(string $ibanDestinataire): self
    {
        $this->ibanDestinataire = $ibanDestinataire;

        return $this;
    }

    public function getCompteEmetteur(): ?Compte
    {
        return $this->compteEmetteur;
    }

    public function setCompteEmetteur(?Compte $compteEmetteur): self
    {
        $this->compteEmetteur = $compteEmetteur;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
