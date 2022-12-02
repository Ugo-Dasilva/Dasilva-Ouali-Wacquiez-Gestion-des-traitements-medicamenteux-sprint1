<?php

namespace App\Entity;

use App\Repository\PharmacienRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PharmacienRepository::class)]
class Pharmaciens extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
