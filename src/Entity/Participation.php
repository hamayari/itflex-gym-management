<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ParticipationRepository;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idpart= null;
   

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(length: 150)]
    private ?string $prenom = null;

    #[ORM\Column(length: 150)]
    private ?string $ntel = null;

    #[ORM\Column]
    private ?\DateTime $datepart = null;
    

    #[ORM\ManyToOne(inversedBy: 'participation')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "idevent",name: "idevent",onDelete: "CASCADE")]

    private ?Events $idevent = null;
    

    #[ORM\ManyToOne(inversedBy: 'participation')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "Id",name: "idUser",onDelete: "CASCADE")]

    private ?User $idUser = null;

    public function getIdpart(): ?int
    {
        return $this->idpart;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->datepart = new \DateTime();
    }


    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNtel(): ?string
    {
        return $this->ntel;
    }

    public function setNtel(string $ntel): static
    {
        $this->ntel = $ntel;

        return $this;
    }

    public function getDatepart(): ?\DateTimeInterface
    {
        return $this->datepart;
    }

    public function setDatepart(\DateTimeInterface $datepart): static
    {
        $this->datepart = $datepart;

        return $this;
    }

    public function getIdevent(): ?Events
    {
        return $this->idevent;
    }

    public function setIdevent(?Events $idevent): static
    {
        $this->idevent = $idevent;

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
   

}
