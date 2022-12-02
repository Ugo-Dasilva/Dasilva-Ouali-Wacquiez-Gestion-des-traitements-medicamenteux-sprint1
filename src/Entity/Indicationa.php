<?php

namespace App\Entity;

use App\Repository\IndicationaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndicationaRepository::class)]
class Indicationa
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
