<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?float $averagePrice = null;

    #[ORM\Column]
    private ?int $maximumCapacity = null;

    #[ORM\Column]
    private ?int $availabilityCapacity = null;

    #[ORM\Column]
    private ?int $numberTable = null;

    #[ORM\Column]
    private ?int $numberChair = null;

    #[ORM\Column(length: 50)]
    private ?string $city = null;

    #[ORM\Column]
    private ?int $zipcode = null;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Hour::class)]
    private Collection $hours;


    public function __construct()
    {
        $this->hours = new ArrayCollection();
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

    public function getAveragePrice(): ?float
    {
        return $this->averagePrice;
    }

    public function setAveragePrice(float $averagePrice): self
    {
        $this->averagePrice = $averagePrice;

        return $this;
    }

    public function getMaximumCapacity(): ?int
    {
        return $this->maximumCapacity;
    }
    
    public function setMaximumCapacity(int $maximumCapacity): self
    {
        $this->maximumCapacity = $maximumCapacity;

        return $this;
    }

    public function getAvailabilityCapacity(): ?int
    {
        return $this->availabilityCapacity;
    }

    public function setAvailabilityCapacity(int $availabilityCapacity): self
    {
        $this->availabilityCapacity = $availabilityCapacity;
        
        return $this;
    }

    public function getNumberTable(): ?int
    {
        return $this->numberTable;
    }
    
    public function setNumberTable(int $numberTable): self
    {
        $this->numberTable = $numberTable;
        
        return $this;
    }
    
    public function getNumberChair(): ?int
    {
        return $this->numberChair;
    }
    
    public function setNumberChair(int $numberChair): self
    {
        $this->numberChair = $numberChair;
        
        return $this;
    }
    
    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return Collection<int, Hour>
     */
    public function getHours(): Collection
    {
        return $this->hours;
    }

    public function addHour(Hour $hour): self
    {
        if (!$this->hours->contains($hour)) {
            $this->hours->add($hour);
            $hour->setRestaurant($this);
        }

        return $this;
    }

    public function removeHour(Hour $hour): self
    {
        if ($this->hours->removeElement($hour)) {
            // set the owning side to null (unless already changed)
            if ($hour->getRestaurant() === $this) {
                $hour->setRestaurant(null);
            }
        }

        return $this;
    }
}
