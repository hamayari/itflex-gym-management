<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AbonnementRepository;
use App\Entity\User;
use App\Entity\TypeAbonn;

#[ORM\Entity(repositoryClass:AbonnementRepository::class)]
class Abonnement
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idabonement")]
    private ?int $idabonement=null;

    
    //#[ORM\Column]
    //private \DateTime $dateabonnement;

    #[ORM\Column(type: "datetime")]
    private \DateTime $dateabonnement;

    public function __construct()
    {
        // Initialisez la date d'abonnement lors de la création de l'objet Abonnement
        $this->dateabonnement = new \DateTime();
    }

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "Id",name: "idUser",onDelete: "CASCADE")]
    private ?User $iduser=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[ORM\ManyToOne(inversedBy: 'typeAbons')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "id",name: "typeAbon",onDelete: "CASCADE")]
    private ?TypeAbonn $typeabon=null;

    #[ORM\Column]
    private ?int $VerificationCode = 0;

    public function getIdabonement(): ?int
    {
        return $this->idabonement;
    }
    /*public function getidabonement() : ?int
    {
        return $this->idabonement;
    }*/

    public function getDateabonnement(): ?\DateTimeInterface
    {
        return $this->dateabonnement;
    }

    public function setDateabonnement(\DateTimeInterface $dateabonnement): static
    {
        $this->dateabonnement = $dateabonnement;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getTypeabon(): ?TypeAbonn
    {
        return $this->typeabon;
    }

    public function setTypeabon(?TypeAbonn $typeabon): static
    {
        $this->typeabon = $typeabon;

        return $this;
    }

    public function getVerificationCode(): ?int
    {
        return $this->VerificationCode;
    }

    public function setVerificationCode(int $VerificationCode): static
    {
        $this->VerificationCode = $VerificationCode;

        return $this;
    }


}
