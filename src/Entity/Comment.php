<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\CommentRepository;
use App\Entity\Post;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idc")]
    private ?int $idc = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy:'post')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName:"idPost", name:"idPost",onDelete:"CASCADE")]
    
    private ?Post $idPost = null;
    
   

    #[ORM\ManyToOne(inversedBy: 'comment')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "Id",name: "idUser",onDelete: "CASCADE")]
    private ?User $idUser = null;

    
    public function getIdc(): ?int
    {
        return $this->idc;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getIdPost(): ?Post
    {
        return $this->idPost;
    }

    public function setIdPost(?Post $idPost): static
    {
        $this->idPost = $idPost;

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
