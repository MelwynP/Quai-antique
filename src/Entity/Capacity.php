<?php

namespace App\Entity;

use App\Repository\CapacityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapacityRepository::class)]
class Capacity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $capacityMaxLunch = null;

    #[ORM\Column]
    private ?int $capacityMaxDinner = null;

    #[ORM\Column]
    private ?int $capacityAvailableLunch = null;

    #[ORM\Column]
    private ?int $capacityAvailableDinner = null;

    #[ORM\OneToMany(mappedBy: 'capacity', targetEntity: Booking::class)]
    private Collection $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacityMaxLunch(): ?int
    {
        return $this->capacityMaxLunch;
    }

    public function setCapacityMaxLunch(int $capacityMaxLunch): self
    {
        $this->capacityMaxLunch = $capacityMaxLunch;

        return $this;
    }

    public function getCapacityMaxDinner(): ?int
    {
        return $this->capacityMaxDinner;
    }

    public function setCapacityMaxDinner(int $capacityMaxDinner): self
    {
        $this->capacityMaxDinner = $capacityMaxDinner;

        return $this;
    }

    public function getCapacityAvailableLunch(): ?int
    {
        return $this->capacityAvailableLunch;
    }

    public function setCapacityAvailableLunch(int $capacityAvailableLunch): self
    {
        $this->capacityAvailableLunch = $capacityAvailableLunch;

        return $this;
    }

    public function getCapacityAvailableDinner(): ?int
    {
        return $this->capacityAvailableDinner;
    }

    public function setCapacityAvailableDinner(int $capacityAvailableDinner): self
    {
        $this->capacityAvailableDinner = $capacityAvailableDinner;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setCapacity($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getCapacity() === $this) {
                $booking->setCapacity(null);
            }
        }

        return $this;
    }
}
