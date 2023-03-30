<?php

namespace App\Entity;

use App\Repository\HourRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HourRepository::class)]
class Hour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'hours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurant = null;

    #[ORM\Column(length: 100)]
    private ?string $dayWeek = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lunchOpeningTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lunchClosingTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dinnerOpeningTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dinnerClosingTime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    public function getDayWeek(): ?string
    {
        return $this->dayWeek;
    }

    public function setDayWeek(string $dayWeek): self
    {
        $this->dayWeek = $dayWeek;

        return $this;
    }

    public function getLunchOpeningTime(): ?\DateTimeInterface
    {
        return $this->lunchOpeningTime;
    }

    public function setLunchOpeningTime(?\DateTimeInterface $lunchOpeningTime): self
    {
        $this->lunchOpeningTime = $lunchOpeningTime;

        return $this;
    }

    public function getLunchClosingTime(): ?\DateTimeInterface
    {
        return $this->lunchClosingTime;
    }

    public function setLunchClosingTime(?\DateTimeInterface $lunchClosingTime): self
    {
        $this->lunchClosingTime = $lunchClosingTime;

        return $this;
    }

    public function getDinnerOpeningTime(): ?\DateTimeInterface
    {
        return $this->dinnerOpeningTime;
    }

    public function setDinnerOpeningTime(?\DateTimeInterface $dinnerOpeningTime): self
    {
        $this->dinnerOpeningTime = $dinnerOpeningTime;

        return $this;
    }

    public function getDinnerClosingTime(): ?\DateTimeInterface
    {
        return $this->dinnerClosingTime;
    }

    public function setDinnerClosingTime(?\DateTimeInterface $dinnerClosingTime): self
    {
        $this->dinnerClosingTime = $dinnerClosingTime;

        return $this;
    }
}
