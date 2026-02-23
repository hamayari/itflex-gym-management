<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\OfferRepository;
use App\Entity\ReservationOffer;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass:OfferRepository::class)]
#[Vich\Uploadable]
class Offer
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idOffer")]
    private ?int $idoffer=null;


    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length:255)]
    private ?string $titleoffer=null;


    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length:255)]
    private ?string $descriptionoffer=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column]
    private ?float $prix=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[ORM\Column]
    private \DateTime $datedeboffer;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\GreaterThanOrEqual(propertyPath: "datedeboffer", message: "La date de fin doit être postérieure à la date de début.")]
    #[ORM\Column]
    private \DateTime $datefinoffer;


    

    #[Vich\UploadableField(mapping: 'art', fileNameProperty: 'img')]
    private ?File $imageFile = null;

    //#[ORM\Column(name: "image_name",length: 255)]
    //private ?string  $imageName = null;
    //#[Assert\NotBlank(message: "champ obligatoire")]
    #[ORM\Column(name: "img",length:255, nullable:true)]
    private ?string $img=null;

    #[ORM\OneToMany(mappedBy: 'idOffer', targetEntity: ReservationOffer::class)]
    private Collection $offers;

    #[ORM\Column]
    private ?int $nb_reservation = 0;

    #[ORM\Column]
    private ?int $nb_max_reservation = 0;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }


    public function getIdoffer(): ?int
    {
        return $this->idoffer;
    }

    public function getTitleoffer(): ?string
    {
        return $this->titleoffer;
    }

    public function setTitleoffer(string $titleoffer): static
    {
        $this->titleoffer = $titleoffer;

        return $this;
    }

    public function getDescriptionoffer(): ?string
    {
        return $this->descriptionoffer;
    }

    public function setDescriptionoffer(string $descriptionoffer): static
    {
        $this->descriptionoffer = $descriptionoffer;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDatedeboffer(): ?\DateTimeInterface
    {
        return $this->datedeboffer;
    }

    public function setDatedeboffer(\DateTimeInterface $datedeboffer): static
    {
        $this->datedeboffer = $datedeboffer;

        return $this;
    }

    public function getDatefinoffer(): ?\DateTimeInterface
    {
        return $this->datefinoffer;
    }

    public function setDatefinoffer(\DateTimeInterface $datefinoffer): static
    {
        $this->datefinoffer = $datefinoffer;

        return $this;
    }

    

    /**
     * @return Collection<int, ReservationOffer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(ReservationOffer $offer): static
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->setIdOffer($this);
        }

        return $this;
    }

    public function removeOffer(ReservationOffer $offer): static
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getIdOffer() === $this) {
                $offer->setIdOffer(null);
            }
        }

        return $this;
    }


     /**
     * @param  File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */


    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        /*if ($imageFile) {
            $this->datedeboffer = new \DateTime('now');
        }*/

        
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;

        
    }

    public function getnb_reservation(): ?int
    {
        return $this->nb_reservation;
    }

    public function setnb_reservation(int $nb_reservation): static
    {
        $this->nb_reservation = $nb_reservation;

        return $this;
    }

    public function getNbReservation(): ?int
    {
        return $this->nb_reservation;
    }

    public function setNbReservation(int $nb_reservation): static
    {
        $this->nb_reservation = $nb_reservation;

        return $this;
    }

    public function getNbMaxReservation(): ?int
    {
        return $this->nb_max_reservation;
    }
    
    public function setNbMaxReservation(int $nb_max_reservation): static
    {
        $this->nb_max_reservation = $nb_max_reservation;

        return $this;
    }
    public function getnb_max_reservation(): ?int
    {
        return $this->nb_max_reservation;
    }
    public function setnb_max_reservation(int $nb_max_reservation): static
    {
        $this->nb_max_reservation = $nb_max_reservation;

        return $this;
    }

    


}
