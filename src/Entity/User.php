<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass:UserRepository::class)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id")]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $nom = null;

    #[ORM\Column(length:255)]
    private ?string $prenom = null;

    #[ORM\Column(length:255)]
    private ?string $mdp = null;

    #[ORM\Column(length:255)]
    private ?string $role = null;

    #[ORM\Column(length:255)]
    private ?string $email = null;

    #[ORM\Column(length:255)]
    private ?string $img = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(name: "numtel", type: "integer", nullable: false)]
    private ?int $numtel = null;

    #[ORM\Column(name: "sex", type: "string", length: 300, nullable: false)]
    private ?string $sex = null;

    

    #[ORM\OneToMany(mappedBy: 'Id', targetEntity: Abonnement::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'Id', targetEntity: ReservationOffer::class)]
    private Collection $usersR;
    #[ORM\OneToMany(mappedBy: "iduser", targetEntity: Commande::class)]
    private Collection $commandes;
    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: Activites::class)]
    private Collection $activites;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: Equipement::class)]
    private Collection $equipements;

    #[ORM\OneToMany(mappedBy: 'Id', targetEntity: Post::class)]
    private Collection $userP;
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->userP = new ArrayCollection();
    }

    public function addUserP(Post $userP): static
    {
        if (!$this->userP->contains($userP)) {
            $this->userP->add($userP);
            $userP->setId($this);

        }

        return $this;
    }
    public function removeUserP(Post $userP): static
    {
        if ($this->userP->removeElement($userP)) {
            // set the owning side to null (unless already changed)
            if ($userP->getId() === $this) {
                $userP->setId(null);

            }
        }

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }


    public function setNom(string $nom): self

    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }


    public function setPrenom(string $prenom): self

    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }


    public function setMdp(string $mdp): self
    {
        // Hash the password using bcrypt algorithm
        $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT);
    
        $this->mdp = $hashedPassword;
    
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }


    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }


    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }


    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }


    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }


    // Required methods for UserInterface

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function getSalt(): ?string
    {
        // You can leave this method blank or return a salt
        return null;
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    public function getsex(): ?string
    {
        return $this->sex;
    }

    public function setsex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getnumtel(): ?int
    {
        return $this->numtel;
    }

    public function setnumtel(int $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setIduser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getIduser() === $this) {
                $commande->setIduser(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Activites>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activites $activite): static
    {
        if (!$this->activites->contains($activite)) {
            $this->activites->add($activite);
            $activite->setIdUser($this);
        }

        return $this;
    }

    public function removeActivite(Activites $activite): static
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getIdUser() === $this) {
                $activite->setIdUser(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNom() . ' ' . $this->getPrenom();
    }
    /**
     * @return Collection<int, ReservationCours>
     */
    public function getReservationCours(): Collection
    {
        return $this->reservationCours;
    }

  /**
     * @return Collection<int, Abonnement>

     */
    public function getUsers(): Collection
    {
        return $this->users;
    }


    public function addUser(Abonnement $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setId($this);
        }

        return $this;
    }


    public function removeUser(Abonnement $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getId() === $this) {
                $user->setId(null);
            }
        }

        return $this;
    }

    /**

     * @return Collection<int, ReservationOffer>
     */
    public function getUsersR(): Collection
    {
        return $this->usersR;
    }

    public function addUsersR(ReservationOffer $usersR): static
    {
        if (!$this->usersR->contains($usersR)) {
            $this->usersR->add($usersR);
            $usersR->setId($this);
        }

        return $this;
    }


    public function removeUsersR(ReservationOffer $usersR): static
    {
        if ($this->usersR->removeElement($usersR)) {
            // set the owning side to null (unless already changed)
            if ($usersR->getId() === $this) {
                $usersR->setId(null);

            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setIdUser($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getIdUser() === $this) {
                $equipement->setIdUser(null);
            }
        }

        return $this;
    }

}

