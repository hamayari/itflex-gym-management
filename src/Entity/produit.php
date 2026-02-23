<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\produitRepository;
use App\Entity\categoriemagasin;

#[ORM\Entity(repositoryClass: produitRepository::class)]
class produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "idAdmin", type: "integer", nullable: true)]
    private ?int $idadmin;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: "datetimetz")]
    private \DateTime $date;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: categoriemagasin::class)]
    #[ORM\JoinColumn(name: "idCategorie", referencedColumnName: "id", nullable: true)]
    private ?categoriemagasin $categorie = null;

    #[ORM\OneToMany(mappedBy: 'Produits', targetEntity: CommandeProduit::class, orphanRemoval: true)]
    private Collection $commandeProduit;

    public function __construct()
    {
        $this->commandeProduit = new ArrayCollection();
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdadmin(): ?int
    {
        return $this->idadmin;
    }

    public function setIdadmin(?int $idadmin): self
    {
        $this->idadmin = $idadmin;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategorie(): ?categoriemagasin
    {
        return $this->categorie;
    }

    public function setCategorie(?categoriemagasin $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, CommandeProduit>
     */
    public function getCommandeProduits(): Collection
    {
        return $this->commandeProduit;
    }

    public function addCommandeProduit(CommandeProduit $commandeProduit): static
    {
        if (!$this->commandeProduit->contains($commandeProduit)) {
            $this->commandeProduit->add($commandeProduit);
            $commandeProduit->setProduits($this);
        }

        return $this;
    }

    public function removeCommandeProduit(CommandeProduit $commandeProduit): static
    {
        if ($this->commandeProduit->removeElement($commandeProduit)) {
            // set the owning side to null (unless already changed)
            if ($commandeProduit->getProduits() === $this) {
                $commandeProduit->setProduits(null);
            }
        }

        return $this;
    }
}