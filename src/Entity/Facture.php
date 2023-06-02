<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_emission = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_delai = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?Locataire $Locataire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmission(): ?\DateTimeInterface
    {
        return $this->date_emission;
    }

    public function setDateEmission(\DateTimeInterface $date_emission): self
    {
        $this->date_emission = $date_emission;

        return $this;
    }

    public function getDateDelai(): ?\DateTimeInterface
    {
        return $this->date_delai;
    }

    public function setDateDelai(\DateTimeInterface $date_delai): self
    {
        $this->date_delai = $date_delai;

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

    public function getLocataire(): ?Locataire
    {
        return $this->Locataire;
    }

    public function setLocataire(?Locataire $Locataire): self
    {
        $this->Locataire = $Locataire;

        return $this;
    }
}
