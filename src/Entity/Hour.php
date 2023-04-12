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

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $lunchOpeningTime = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $lunchClosingTime = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $dinnerOpeningTime = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $dinnerClosingTime = null;
    
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
    
    public function getLunchOpeningTime()
    {
        return $this->lunchOpeningTime;
    }


    public function setLunchOpeningTime($lunchOpeningTime)
    {
        $this->lunchOpeningTime = $lunchOpeningTime;

        return $this;
    }

    public function getLunchClosingTime()
    {
        return $this->lunchClosingTime;
    }

    public function setLunchClosingTime($lunchClosingTime)
    {
        $this->lunchClosingTime = $lunchClosingTime;

        return $this;
    }

    public function getDinnerOpeningTime()
    {
        return $this->dinnerOpeningTime;
    }

    public function setDinnerOpeningTime($dinnerOpeningTime)
    {
        $this->dinnerOpeningTime = $dinnerOpeningTime;

        return $this;
    }

    public function getDinnerClosingTime()
    {
        return $this->dinnerClosingTime;
    }

    public function setDinnerClosingTime($dinnerClosingTime)
    {
        $this->dinnerClosingTime = $dinnerClosingTime;

        return $this;
    }
}
