<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ActivitesRepository;
//use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActivitesRepository::class)]

class Activites
{

     #[ORM\Id]
     #[ORM\GeneratedValue]
     #[ORM\Column(name:"code")]

    private ?int $code= null;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $categorie;

    #[ORM\Column]
    private ?\DateTime $dateDeb = null;

    #[ORM\Column]
    private ?\DateTime $dateFin = null;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length: 255 )]
    private ?string  $description;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length: 255 )]
    private ?string $salle=null;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length: 255 )]
    private ?string $titre;

    #[ORM\ManyToOne(inversedBy: 'activites')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "id",name: "idcategorie",onDelete: "CASCADE")]
    private ?Categorieactivite $idcategorie = null;
    #[ORM\ManyToOne(inversedBy: 'activites')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "Id", name: "idUser", onDelete: "CASCADE")]
    private ?User $idUser = null;

    #[ORM\OneToMany(mappedBy: 'code', targetEntity: ReservationCours::class)]
    private Collection $activites;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(?\DateTimeInterface $dateDeb): static
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(?string $salle): static
    {
        $this->salle = $salle;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIdcategorie(): ?Categorieactivite
    {
        return $this->idcategorie;
    }

    public function setIdcategorie(?Categorieactivite $idcategorie): static
    {
        $this->idcategorie = $idcategorie;

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

    /**
     * @return Collection<int, ReservationCours>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(ReservationCours $activite): static
    {
        if (!$this->activites->contains($activite)) {
            $this->activites->add($activite);
            $activite->setCode($this);
        }

        return $this;
    }

    public function removeActivite(ReservationCours $activite): static
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getCode() === $this) {
                $activite->setCode(null);
            }
        }

        return $this;
    }


}
