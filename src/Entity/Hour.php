<?php

namespace App\Entity;

use App\Repository\HourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HourRepository::class)]
class Hour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dayWeek = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $openingTime = null;

    #[ORM\ManyToMany(targetEntity: Restaurant::class, inversedBy: 'hours')]
    private Collection $restaurant;

    public function __construct()
    {
        $this->restaurant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayWeek(): ?\DateTimeInterface
    {
        return $this->dayWeek;
    }

    public function setDayWeek(\DateTimeInterface $dayWeek): self
    {
        $this->dayWeek = $dayWeek;

        return $this;
    }

    public function getOpeningTime(): ?\DateTimeInterface
    {
        return $this->openingTime;
    }

    public function setOpeningTime(\DateTimeInterface $openingTime): self
    {
        $this->openingTime = $openingTime;

        return $this;
    }

    /**
     * @return Collection<int, Restaurant>
     */
    public function getRestaurant(): Collection
    {
        return $this->restaurant;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurant->contains($restaurant)) {
            $this->restaurant->add($restaurant);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        $this->restaurant->removeElement($restaurant);

        return $this;
    }
}
