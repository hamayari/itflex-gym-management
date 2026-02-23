<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class CommandeProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandeProduits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $Commandes = null;

    #[ORM\ManyToOne(inversedBy: 'commandeProduit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?produit $Produits = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommandes(): ?Commande
    {
        return $this->Commandes;
    }

    public function setCommandes(?Commande $Commandes): static
    {
        $this->Commandes = $Commandes;

        return $this;
    }

    public function getProduits(): ?produit
    {
        return $this->Produits;
    }

    public function setProduits(?produit $Produits): static
    {
        $this->Produits = $Produits;

        return $this;
    }


}
