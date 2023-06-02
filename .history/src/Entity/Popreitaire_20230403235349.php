<?php

namespace App\Entity;

use App\Repository\PopreitaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PopreitaireRepository::class)]
class Popreitaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?BienImmobilier $BienImmobilier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBienImmobilier(): ?BienImmobilier
    {
        return $this->BienImmobilier;
    }

    public function setBienImmobilier(?BienImmobilier $BienImmobilier): self
    {
        $this->BienImmobilier = $BienImmobilier;

        return $this;
    }
}
