<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_posts_list", "get_post_by_id"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_posts_list", "get_post_by_id"})
     * @Assert\NotBlank
     * @Assert\Length(min = 5, minMessage = "Il faut au minimum {{ limit }} caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_posts_list", "get_post_by_id"}) 
     * @Assert\NotBlank
     * @Assert\Length(min = 10, minMessage = "Il faut au minimum {{ limit }} caractères")
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_posts_list", "get_post_by_id"}) 
     * @Assert\NotBlank
     * @Assert\Length(min = 10, minMessage = "Il faut au minimum {{ limit }} caractères")
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get_posts_list", "get_post_by_id"})
     * @Assert\NotBlank
     */
    private $publication_date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_posts_list", "get_post_by_id"}) 
     * @Assert\NotBlank
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(\DateTimeInterface $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
