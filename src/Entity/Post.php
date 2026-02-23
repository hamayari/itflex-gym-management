<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;

#[ORM\Entity(repositoryClass: PostRepository::class)]

class Post
{
    public function getTitle(): ?string
    {
        // Ajoutez la logique pour obtenir le titre du post, par exemple, en utilisant la description
        return $this->getDescription();
    }
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name :"idPost")]
    private ?int $idPost= null;
    

    #[ORM\Column(length: 150)]

    private ?string $description = null;

    #[ORM\Column(length: 150)]

    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'post')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "Id",name: "idUser",onDelete: "CASCADE")]
    private ?User $idUser = null;

    

    #[ORM\OneToMany(mappedBy: 'Id', targetEntity: Comment::class)]
  
private Collection $post;


    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getIdPost(): ?int
    {
        return $this->idPost;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

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
     * @return Collection<int, Comment>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Comment $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setIdpost($this);  
        }

        return $this;
    }

    public function removePost(Comment $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getIdpost() === $this) {
                $post->setIdpost(null);
            }
        }

        return $this;
    }


}