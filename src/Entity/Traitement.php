<?php

namespace App\Entity;

use App\Repository\TraitementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitementRepository::class)]
class Traitement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Datefin = null;

    #[ORM\ManyToOne(inversedBy: 'traitement')]
    private ?Sejour $sejour = null;

    #[ORM\OneToMany(mappedBy: 'traitement', targetEntity: Indication::class)]
    private Collection $indication;

    public function __construct()
    {
        $this->indication = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

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

    public function getSejour(): ?Sejour
    {
        return $this->sejour;
    }

    public function setSejour(?Sejour $sejour): self
    {
        $this->sejour = $sejour;

        return $this;
    }

    /**
     * @return Collection<int, Indication>
     */
    public function getIndication(): Collection
    {
        return $this->indication;
    }

    public function addIndication(Indication $indication): self
    {
        if (!$this->indication->contains($indication)) {
            $this->indication->add($indication);
            $indication->setTraitement($this);
        }

        return $this;
    }

    public function removeIndication(Indication $indication): self
    {
        if ($this->indication->removeElement($indication)) {
            // set the owning side to null (unless already changed)
            if ($indication->getTraitement() === $this) {
                $indication->setTraitement(null);
            }
        }

        return $this;
    }
}
