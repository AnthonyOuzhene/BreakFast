<?php

namespace App\Entity;

use App\Repository\BakeryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=BakeryRepository::class)
 */
class Bakery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Groups ({"api_user"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Groups({"api_user"})
     * @Assert\NotBlank
     * 
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     * @Assert\Length(min = 5, minMessage = "Il faut au minimum {{ limit }} caractères")
     * 
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     * @Assert\Url(message="L'url '{{ value }}' n'est pas une url valide")
     * 
     */
    private $profile_img;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $phone_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\PositiveOrZero
     * @Assert\NotBlank
     */
    private $rating;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     *  
     */
    private $status;

    /**
     * @ORM\Column(type="float")
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     * @Assert\PositiveOrZero
     */
    private $delivery_fees;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"api_products_list"})
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     */
    private $delivery_time;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="bakery")
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bakeries")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_bakeries_list", "get_bakery_by_id"})
     * @Assert\NotBlank
     */
    private $user;

    public function __construct()
    {
        $this->product = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getProfileImg(): ?string
    {
        return $this->profile_img;
    }

    public function setProfileImg(string $profile_img): self
    {
        $this->profile_img = $profile_img;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(int $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDeliveryFees(): ?float
    {
        return $this->delivery_fees;
    }

    public function setDeliveryFees(float $delivery_fees): self
    {
        $this->delivery_fees = $delivery_fees;

        return $this;
    }

    public function getDeliveryTime(): ?int
    {
        return $this->delivery_time;
    }

    public function setDeliveryTime(int $delivery_time): self
    {
        $this->delivery_time = $delivery_time;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
            $product->setBakery($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getBakery() === $this) {
                $product->setBakery(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
