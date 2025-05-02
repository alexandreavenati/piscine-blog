<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// lie la claase à un tableau de la bdd
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    // clé primaire
    #[ORM\Id]
    // auto incrémentation
    #[ORM\GeneratedValue]
    // création de la colonne 'id'
    #[ORM\Column]
    private ?int $id = null;

    // création de la colonne 'title' de type varchar(255)
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    // création de la colonne 'description' de type varchar(255)
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    // création de la colonne 'content' de type text
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    // création de la colonne 'image' de type varchar(255)
    #[ORM\Column(length: 255)]
    private ?string $image = null;

    // création de la colonne 'created_at' de type datetime
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    // création de la colonne 'is_published' de type boolean
    #[ORM\Column]
    private ?bool $isPublished = null;

    // méthode pour créer un article
    public function __construct($title, $description, $content, $image)
    {
        // données envoyées par l'utilisateur
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->image = $image;

        // données remplies automatiquement lors de l'envoi
        $this->createdAt = new DateTime();
        $this->isPublished = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
