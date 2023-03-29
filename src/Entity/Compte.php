<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 12)]
    private ?string $numCompte = null;

    #[ORM\Column(length: 27)]
    private ?string $iban = null;

    #[ORM\Column(length: 15)]
    private ?string $titre = null;

    #[ORM\Column(length: 5)]
    private ?string $codeBanque = null;

    #[ORM\OneToMany(mappedBy: 'compteBeneficiaire', targetEntity: VirementEntrant::class)]
    private Collection $virementEntrants;

    #[ORM\OneToMany(mappedBy: 'compteEmetteur', targetEntity: VirementSortant::class)]
    private Collection $virementSortants;

    #[ORM\ManyToOne(inversedBy: 'comptes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $client = null;

    public function __construct()
    {
        $this->virementEntrants = new ArrayCollection();
        $this->virementSortants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCompte(): ?string
    {
        return $this->numCompte;
    }

    public function setNumCompte(string $numCompte): self
    {
        $this->numCompte = $numCompte;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCodeBanque(): ?string
    {
        return $this->codeBanque;
    }

    public function setCodeBanque(string $codeBanque): self
    {
        $this->codeBanque = $codeBanque;

        return $this;
    }

    /**
     * @return Collection<int, VirementEntrant>
     */
    public function getVirementEntrants(): Collection
    {
        return $this->virementEntrants;
    }

    public function addVirementEntrant(VirementEntrant $virementEntrant): self
    {
        if (!$this->virementEntrants->contains($virementEntrant)) {
            $this->virementEntrants->add($virementEntrant);
            $virementEntrant->setCompteBeneficiaire($this);
        }

        return $this;
    }

    public function removeVirementEntrant(VirementEntrant $virementEntrant): self
    {
        if ($this->virementEntrants->removeElement($virementEntrant)) {
            // set the owning side to null (unless already changed)
            if ($virementEntrant->getCompteBeneficiaire() === $this) {
                $virementEntrant->setCompteBeneficiaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VirementSortant>
     */
    public function getVirementSortants(): Collection
    {
        return $this->virementSortants;
    }

    public function addVirementSortant(VirementSortant $virementSortant): self
    {
        if (!$this->virementSortants->contains($virementSortant)) {
            $this->virementSortants->add($virementSortant);
            $virementSortant->setCompteEmetteur($this);
        }

        return $this;
    }

    public function removeVirementSortant(VirementSortant $virementSortant): self
    {
        if ($this->virementSortants->removeElement($virementSortant)) {
            // set the owning side to null (unless already changed)
            if ($virementSortant->getCompteEmetteur() === $this) {
                $virementSortant->setCompteEmetteur(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Utilisateur
    {
        return $this->client;
    }

    public function setClient(?Utilisateur $client): self
    {
        $this->client = $client;

        return $this;
    }
}
