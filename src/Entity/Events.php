<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EventsRepository;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity(repositoryClass: EventsRepository::class)]

class Events
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name :"idevent")]
    private ?int $idevent= null;
    

    #[ORM\Column(length: 150)]
    private ?string $titreevent = null;

    #[ORM\Column(length: 150)]
    private ?string $nomcoach = null;

    #[ORM\Column(length: 150)]

    private ?string $typeevent = null;

    #[ORM\Column(length: 150)]

    private ?string $adresseevent = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: "Id", name: "idUser", onDelete: "CASCADE")]
    private ?User $idUser = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "Id",name: "idtype",onDelete: "CASCADE")]
    private ?TypeEvent $idtype = null;

    
    #[ORM\Column]
    private ?float $prixevent = null;

    #[ORM\Column]
    private ?\DateTime $dateevent = null;

    #[ORM\Column(length: 150)]

    private ?string $imgevent = null;

    #[ORM\OneToMany(targetEntity: "Participation", mappedBy: "events")]
    private Collection $participations;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
    }

    #[ORM\OneToMany(targetEntity: "Participation", mappedBy: "events")]
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

   
    #[ORM\Column]
    private ?int $nombreplacesreservees= null;
    

    #[ORM\Column]
    private ?int $nombreplacestotal= null;
   
    

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getTitreevent(): ?string
    {
        return $this->titreevent;
    }

    public function setTitreevent(string $titreevent): static
    {
        $this->titreevent = $titreevent;

        return $this;
    }

    public function getNomcoach(): ?string
    {
        return $this->nomcoach;
    }

    public function setNomcoach(string $nomcoach): static
    {
        $this->nomcoach = $nomcoach;

        return $this;
    }

    public function getTypeevent(): ?string
    {
        return $this->typeevent;
    }

    public function setTypeevent(string $typeevent): static
    {
        $this->typeevent = $typeevent;

        return $this;
    }

    public function getAdresseevent(): ?string
    {
        return $this->adresseevent;
    }

    public function setAdresseevent(string $adresseevent): static
    {
        $this->adresseevent = $adresseevent;

        return $this;
    }

    public function getPrixevent(): ?float
    {
        return $this->prixevent;
    }

    public function setPrixevent(float $prixevent): static
    {
        $this->prixevent = $prixevent;

        return $this;
    }

    public function getDateevent(): ?\DateTimeInterface
    {
        return $this->dateevent;
    }

    public function setDateevent(\DateTimeInterface $dateevent): static
    {
        $this->dateevent = $dateevent;

        return $this;
    }

    public function getImgevent(): ?string
    {
        return $this->imgevent;
    }

    public function setImgevent(string $imgevent): static
    {
        $this->imgevent = $imgevent;

        return $this;
    }

    public function getNombreplacesreservees(): ?int
    {
        return $this->nombreplacesreservees;
    }

    public function setNombreplacesreservees(int $nombreplacesreservees): static
    {
        $this->nombreplacesreservees = $nombreplacesreservees;

        return $this;
    }

    public function getNombreplacestotal(): ?int
    {
        return $this->nombreplacestotal;
    }

    public function setNombreplacestotal(int $nombreplacestotal): static
    {
        $this->nombreplacestotal = $nombreplacestotal;

        return $this;
    }

     /**
     * @return User|null
     */
    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

   /**
     * @param User|null $idUser
     * @return $this
     */
    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdtype(): ?TypeEvent
    {
        return $this->idtype;
    }

    public function setIdtype(?TypeEvent $idtype): static
    {
        $this->idtype = $idtype;

        return $this;
    }
    
    public function getQrcode(): string
    {
        return $this->qrcode;
    }

    /**
     * @param string $qrcode
     */
    public function setQrcode(string $qrcode): void
    {
        $this->qrcode = $qrcode;
    }

}
