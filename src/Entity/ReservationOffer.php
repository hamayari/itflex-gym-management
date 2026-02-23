<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationOfferRepository;


#[ORM\Entity(repositoryClass:ReservationOfferRepository::class)]
class ReservationOffer
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idReservation")]
    private ?int $idreservation=null;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP"])]
    private \DateTime $datereservation;

    #[ORM\Column(length:255)]
    #[Assert\NotBlank(message: "vous devez mettre title Offer!!!")]
    private ?string $codepromo=null;



    #[ORM\ManyToOne(inversedBy: 'usersR')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "Id",name: "idUser",onDelete: "CASCADE")]
    private ?User $iduser=null;



    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "idOffer",name: "idOffer",onDelete: "CASCADE")]
    private ?Offer $idoffer=null;
   

    public function getIdreservation(): ?int
    {
        return $this->idreservation;
    }

    public function getDatereservation(): ?\DateTimeInterface
    {
        return $this->datereservation;
    }

    public function setDatereservation(\DateTimeInterface $datereservation): static
    {
        $this->datereservation = $datereservation;

        return $this;
    }

    public function getCodepromo(): ?string
    {
        return $this->codepromo;
    }

    public function setCodepromo(string $codepromo): static
    {
        $this->codepromo = $codepromo;

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

    public function getIdoffer(): ?Offer
    {
        return $this->idoffer;
    }

    public function setIdoffer(?Offer $idoffer): static
    {
        $this->idoffer = $idoffer;

        return $this;
    }


}
