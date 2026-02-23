<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "IdCategorie")]
    private ?int $IdCategorie = null;

    
    #[ORM\Column(name: "NomCategorie", length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Nom categorie doit être au moins  {{ limit }} characteres ',
        maxMessage: 'Nom categorie pas depasser {{ limit }} characteres',
    )]
    private ?string $NomCategorie = null;

    #[ORM\Column(name: "DescriptionCategorie", length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 4,
        max: 255,
        minMessage: 'Description categorie doit être au moins  {{ limit }} characteres ',
        maxMessage: 'Description categorie pas depasser {{ limit }} characteres',
    )]
    private ?string $DescriptionCategorie = null;

    #[ORM\OneToMany(mappedBy: 'IdCategorie', targetEntity: Equipement::class)]
    private Collection $equipements;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
    }

    public function getIdCategorie(): ?int
    {
        return $this->IdCategorie;
    }

    public function getNomCategorie(): ?string
    {
        return $this->NomCategorie;
    }

    public function setNomCategorie(string $NomCategorie): static
    {
        $this->NomCategorie = $NomCategorie;

        return $this;
    }

    public function getDescriptionCategorie(): ?string
    {
        return $this->DescriptionCategorie;
    }

    public function setDescriptionCategorie(string $DescriptionCategorie): static
    {
        $this->DescriptionCategorie = $DescriptionCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setIdCategorie($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getIdCategorie() === $this) {
                $equipement->setIdCategorie(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->IdCategorie;
    }
}
