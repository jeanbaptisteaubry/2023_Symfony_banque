<?php

namespace App\Entity;

use App\Repository\VirementEntrantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VirementEntrantRepository::class)]
class VirementEntrant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(length: 27)]
    private ?string $ibanEmetteur = null;

    #[ORM\ManyToOne(inversedBy: 'virementEntrants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compte $compteBeneficiaire = null;

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

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getIbanEmetteur(): ?string
    {
        return $this->ibanEmetteur;
    }

    public function setIbanEmetteur(string $ibanEmetteur): self
    {
        $this->ibanEmetteur = $ibanEmetteur;

        return $this;
    }

    public function getCompteBeneficiaire(): ?Compte
    {
        return $this->compteBeneficiaire;
    }

    public function setCompteBeneficiaire(?Compte $compteBeneficiaire): self
    {
        $this->compteBeneficiaire = $compteBeneficiaire;

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
