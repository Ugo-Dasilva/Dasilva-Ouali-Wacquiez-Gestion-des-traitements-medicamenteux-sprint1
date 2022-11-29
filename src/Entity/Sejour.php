<?php

namespace App\Entity;

use App\Repository\SejourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SejourRepository::class)]
class Sejour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Datedebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Datefin = null;

    #[ORM\ManyToOne(inversedBy: 'sejour')]
    private ?Patient $patient = null;

    #[ORM\OneToMany(mappedBy: 'sejour', targetEntity: Traitement::class)]
    private Collection $traitement;

    public function __construct()
    {
        $this->traitement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->Datedebut;
    }

    public function setDatedebut(\DateTimeInterface $Datedebut): self
    {
        $this->Datedebut = $Datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->Datefin;
    }

    public function setDatefin(\DateTimeInterface $Datefin): self
    {
        $this->Datefin = $Datefin;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * @return Collection<int, Traitement>
     */
    public function getTraitement(): Collection
    {
        return $this->traitement;
    }

    public function addTraitement(Traitement $traitement): self
    {
        if (!$this->traitement->contains($traitement)) {
            $this->traitement->add($traitement);
            $traitement->setSejour($this);
        }

        return $this;
    }

    public function removeTraitement(Traitement $traitement): self
    {
        if ($this->traitement->removeElement($traitement)) {
            // set the owning side to null (unless already changed)
            if ($traitement->getSejour() === $this) {
                $traitement->setSejour(null);
            }
        }

        return $this;
    }
}
