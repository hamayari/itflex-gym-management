<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "IdEquipement")]
    private ?int $IdEquipement = null;


    #[ORM\Column(name: "NomEquipement" , length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Nom equipement doit être au moins  {{ limit }} characteres ',
        maxMessage: 'Nom equipement pas depasser {{ limit }} characteres',
    )]
    private ?string $NomEquipement = null;

    #[ORM\Column(name: "Quantite")]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?int $Quantite = null;

    #[ORM\Column( name: "DateAchat" , type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $DateAchat = null;

    #[ORM\Column(name: "PrixAchat")]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?float $PrixAchat = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    #[ORM\JoinColumn(name: 'IdCategorie', referencedColumnName: 'IdCategorie', nullable: false)]
    private ?Categorie $IdCategorie = null;
     
    #[ORM\ManyToOne(inversedBy: 'equipements')]
    #[ORM\JoinColumn(name: 'idUser', referencedColumnName: 'Id', nullable: false)]
    private ?User $idUser = null;

    


    public function getIdEquipement(): ?int
    {
        return $this->IdEquipement;
    }

    public function getNomEquipement(): ?string
    {
        return $this->NomEquipement;
    }

    public function setNomEquipement(string $NomEquipement): static
    {
        $this->NomEquipement = $NomEquipement;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): static
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->DateAchat;
    }

    public function setDateAchat(\DateTimeInterface $DateAchat): static
    {
        $this->DateAchat = $DateAchat;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->PrixAchat;
    }

    public function setPrixAchat(float $PrixAchat): static
    {
        $this->PrixAchat = $PrixAchat;

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->IdCategorie;
    }

    public function setIdCategorie(?Categorie $IdCategorie): static
    {
        $this->IdCategorie = $IdCategorie;

        return $this;
    }
    
    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function __toString()
    {
        return $this->IdEquipement;
    }
}
