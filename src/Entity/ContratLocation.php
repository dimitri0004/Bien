<?php

namespace App\Entity;

use App\Repository\ContratLocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratLocationRepository::class)]
class ContratLocation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column]
    private ?float $loyer_mensuel = null;

    #[ORM\Column]
    private ?float $montant_guarrantie = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Locataire $Locataire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getLoyerMensuel(): ?float
    {
        return $this->loyer_mensuel;
    }

    public function setLoyerMensuel(float $loyer_mensuel): self
    {
        $this->loyer_mensuel = $loyer_mensuel;

        return $this;
    }

    public function getMontantGuarrantie(): ?float
    {
        return $this->montant_guarrantie;
    }

    public function setMontantGuarrantie(float $montant_guarrantie): self
    {
        $this->montant_guarrantie = $montant_guarrantie;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->Locataire;
    }

    public function setLocataire(Locataire $Locataire): self
    {
        $this->Locataire = $Locataire;

        return $this;
    }
}
