<?php

namespace App\Entity;

use App\Repository\categoriemagasinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: categoriemagasinRepository::class)]
class categoriemagasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "id")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Méthode magique pour convertir l'objet en chaîne de caractères.
     */
    public function __toString(): string
    {
        return $this->getCategorie() ?? '';
    }
}