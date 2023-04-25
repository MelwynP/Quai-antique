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
}
