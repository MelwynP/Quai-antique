<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 50)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $average_price = null;

    #[ORM\Column]
    private ?int $maximum_capacity = null;

    #[ORM\Column]
    private ?int $availability_capacity = null;

    #[ORM\Column]
    private ?int $number_table = null;

    #[ORM\Column]
    private ?int $number_chair = null;

    public function __construct()
    {
        $this->hour = new ArrayCollection();
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    public function getAveragePrice(): ?string
    {
        return $this->average_price;
    }

    public function setAveragePrice(string $average_price): self
    {
        $this->average_price = $average_price;

        return $this;
    }

    public function getMaximumCapacity(): ?int
    {
        return $this->maximum_capacity;
    }

    public function setMaximumCapacity(int $maximum_capacity): self
    {
        $this->maximum_capacity = $maximum_capacity;

        return $this;
    }

    public function getAvailabilityCapacity(): ?int
    {
        return $this->availability_capacity;
    }

    public function setAvailabilityCapacity(int $availability_capacity): self
    {
        $this->availability_capacity = $availability_capacity;

        return $this;
    }

    public function getNumberTable(): ?int
    {
        return $this->number_table;
    }

    public function setNumberTable(int $number_table): self
    {
        $this->number_table = $number_table;

        return $this;
    }

    public function getNumberChair(): ?int
    {
        return $this->number_chair;
    }

    public function setNumberChair(int $number_chair): self
    {
        $this->number_chair = $number_chair;

        return $this;
    }
}
