<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeEventRepository;

#[ORM\Entity(repositoryClass: TypeEventRepository::class)]

class TypeEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id")]
    private ?int $id= null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "vous devez mettre le type event !!!")]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'idevent', targetEntity: Events::class)]
    private Collection $typeEvent;

    public function __construct()
    {
        $this->typeEvent = new ArrayCollection();
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
     * @return Collection<int, Events>
     */
    public function getTypeEvent(): Collection
    {
        return $this->typeEvent;
    }

    public function addTypeEvent(Events $typeEvent): static
    {
        if (!$this->typeEvent->contains($typeEvent)) {
            $this->typeEvent->add($typeEvent);
            $typeEvent->setIdevent($this);
        }

        return $this;
    }

    public function removeTypeEvent(Events $typeEvent): static
    {
        if ($this->typeEvent->removeElement($typeEvent)) {
            // set the owning side to null (unless already changed)
            if ($typeEvent->getIdevent() === $this) {
                $typeEvent->setIdevent(null);
            }
        }

        return $this;
    }


}
