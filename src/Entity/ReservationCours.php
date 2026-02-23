<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationCoursRepository;

#[ORM\Entity(repositoryClass: ReservationCoursRepository::class)]
class ReservationCours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id")]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $dateRes = null;

    #[ORM\ManyToOne(inversedBy: 'reservationCours')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: "Id", name: "idUser", onDelete: "CASCADE")]
    private ?User $idUser = null;

    #[ORM\ManyToOne(inversedBy: 'activites')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: "code", name: "code", onDelete: "CASCADE")]
    private ?Activites $code = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRes(): ?\DateTime
    {
        return $this->dateRes;
    }

    public function setDateRes(?\DateTime $dateRes): static
    {
        $this->dateRes = $dateRes;

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

    public function getCode(): ?Activites
    {
        return $this->code;
    }

    public function setCode(?Activites $code): static
    {
        $this->code = $code;

        return $this;
    }
}

