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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $day_week = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $opening_time = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closing_time = null;

    #[ORM\Column]
    private ?bool $is_service_period = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayWeek(): ?\DateTimeInterface
    {
        return $this->day_week;
    }

    public function setDayWeek(\DateTimeInterface $day_week): self
    {
        $this->day_week = $day_week;

        return $this;
    }

    public function getOpeningTime(): ?\DateTimeInterface
    {
        return $this->opening_time;
    }

    public function setOpeningTime(\DateTimeInterface $opening_time): self
    {
        $this->opening_time = $opening_time;

        return $this;
    }

    public function getClosingTime(): ?\DateTimeInterface
    {
        return $this->closing_time;
    }

    public function setClosingTime(\DateTimeInterface $closing_time): self
    {
        $this->closing_time = $closing_time;

        return $this;
    }

    public function isIsServicePeriod(): ?bool
    {
        return $this->is_service_period;
    }

    public function setIsServicePeriod(bool $is_service_period): self
    {
        $this->is_service_period = $is_service_period;

        return $this;
    }
}
