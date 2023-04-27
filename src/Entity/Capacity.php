<?php

namespace App\Entity;

use App\Repository\CapacityRepository;
use Doctrine\ORM\Mapping as ORM;
//use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: CapacityRepository::class)]
//#[ApiResource]


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
    private ?int $numberTable = null;

    #[ORM\Column]
    private ?int $numberChair = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getCapacity($type)
    // {
    //     $ret = $capacityRepository->find($type)->number;
    //     return $ret;
    // }

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
}
