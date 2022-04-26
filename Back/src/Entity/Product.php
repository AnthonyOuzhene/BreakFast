<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * 
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"api_products_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     * 
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Groups({"api_products_list"})
     * @Assert\NotBlank
     * @Assert\PositiveOrZero 
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api_products_list"})
     * @Assert\NotBlank
     * @Assert\Length(max = 100, maxMessage = "Il faut au maximum {{ limit }} caractères")
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api_products_list"})
     * @Assert\NotBlank
     * @Assert\Url(message="L'url '{{ value }}' n'est pas une url valide")
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=Bakery::class, inversedBy="product")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"api_products_list"})
     * @Assert\NotBlank
     * 
     */
    private $bakery;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="products")
     * @Groups({"api_products_list"})
     * @Assert\NotBlank
     * 
     */
    private $tag;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"api_products_list"})
     * @Assert\NotBlank
     * 
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Order::class, mappedBy="product")
     */
    private $orders;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getBakery(): ?Bakery
    {
        return $this->bakery;
    }

    public function setBakery(?Bakery $bakery): self
    {
        $this->bakery = $bakery;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->addProduct($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            $order->removeProduct($this);
        }

        return $this;
    }
    public function getCustom() {
        return $this->bakery->getName() . ' - ' . $this->name;
    }
}
