<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicamentRepository::class)]
class Medicament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'medicament', targetEntity: Indication::class)]
    private Collection $indications;

<<<<<<< HEAD
    #[ORM\ManyToMany(targetEntity: Effetsecondaire::class, mappedBy: 'medicament')]
    private Collection $effetsecondaires;
=======
    #[ORM\Column(nullable: true)]
    private ?int $Quantite = null;
>>>>>>> b5f6e011097190b55ee986f66f87d8a2bb771c04

    public function __construct()
    {
        $this->indications = new ArrayCollection();
        $this->effetsecondaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Indication>
     */
    public function getIndications(): Collection
    {
        return $this->indications;
    }

    public function addIndication(Indication $indication): self
    {
        if (!$this->indications->contains($indication)) {
            $this->indications->add($indication);
            $indication->setMedicament($this);
        }

        return $this;
    }

    public function removeIndication(Indication $indication): self
    {
        if ($this->indications->removeElement($indication)) {
            // set the owning side to null (unless already changed)
            if ($indication->getMedicament() === $this) {
                $indication->setMedicament(null);
            }
        }

        return $this;
    }

<<<<<<< HEAD
    /**
     * @return Collection<int, Effetsecondaire>
     */
    public function getEffetsecondaires(): Collection
    {
        return $this->effetsecondaires;
    }

    public function addEffetsecondaire(Effetsecondaire $effetsecondaire): self
    {
        if (!$this->effetsecondaires->contains($effetsecondaire)) {
            $this->effetsecondaires->add($effetsecondaire);
            $effetsecondaire->addMedicament($this);
        }

        return $this;
    }

    public function removeEffetsecondaire(Effetsecondaire $effetsecondaire): self
    {
        if ($this->effetsecondaires->removeElement($effetsecondaire)) {
            $effetsecondaire->removeMedicament($this);
        }
=======
    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(?int $Quantite): self
    {
        $this->Quantite = $Quantite;
>>>>>>> b5f6e011097190b55ee986f66f87d8a2bb771c04

        return $this;
    }
}
