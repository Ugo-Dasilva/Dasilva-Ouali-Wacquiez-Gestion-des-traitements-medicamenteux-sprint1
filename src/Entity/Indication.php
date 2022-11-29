<?php

namespace App\Entity;

use App\Repository\IndicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndicationRepository::class)]
class Indication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Posologie = null;

    #[ORM\ManyToOne(inversedBy: 'indication')]
    private ?Traitement $traitement = null;

    #[ORM\ManyToOne(inversedBy: 'indications')]
    private ?Medicament $medicament = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosologie(): ?string
    {
        return $this->Posologie;
    }

    public function setPosologie(string $Posologie): self
    {
        $this->Posologie = $Posologie;

        return $this;
    }

    public function getTraitement(): ?Traitement
    {
        return $this->traitement;
    }

    public function setTraitement(?Traitement $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }
}
