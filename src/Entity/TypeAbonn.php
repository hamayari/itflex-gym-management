<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\TypeAbonnRepository;
use App\Entity\Abonnement;

#[ORM\Entity(repositoryClass:TypeAbonnRepository::class)]
class TypeAbonn 
{
 
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id")]
    private ?int $id=null;


    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length:255)]
    private ?string $type=null;

    #[ORM\OneToMany(mappedBy: 'id', targetEntity: Abonnement::class)]
    private Collection $typeAbons;

    #[ORM\Column]
    private ?int $nb_abonnement = 0;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    public function __construct()
    {
        $this->typeAbons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Abonnement>
     */
    public function getTypeAbons(): Collection
    {
        return $this->typeAbons;
    }

    public function addTypeAbon(Abonnement $typeAbon): static
    {
        if (!$this->typeAbons->contains($typeAbon)) {
            $this->typeAbons->add($typeAbon);
            $typeAbon->setId($this);
        }

        return $this;
    }

    public function removeTypeAbon(Abonnement $typeAbon): static
    {
        if ($this->typeAbons->removeElement($typeAbon)) {
            // set the owning side to null (unless already changed)
            if ($typeAbon->getId() === $this) {
                $typeAbon->setId(null);
            }
        }

        return $this;
    }

    public function getNbAbonnement(): ?int
    {
        return $this->nb_abonnement;
    }

    public function setNbAbonnement(int $nb_abonnement): static
    {
        $this->nb_abonnement = $nb_abonnement;

        return $this;
    }
    
    public function getnb_abonnement(): ?int
    {
        return $this->nb_abonnement;
    }
    public function setnb_abonnement(int $nb_abonnement): static
    {
        $this->nb_abonnement = $nb_abonnement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }


}
