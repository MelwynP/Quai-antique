<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 2)]
    private ?string $price = null;

    #[ORM\ManyToMany(targetEntity: Flat::class, inversedBy: 'menu')]
    private Collection $flat;

    public function __construct()
    {
        $this->flat = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }


    /**
     * @return Collection<int, Flat>
     */
    public function getFlat(): Collection
    {
        return $this->flat;
    }

    public function addFlat(Flat $flat): self
    {
        if (!$this->flat->contains($flat)) {
            $this->flat->add($flat);
        }

        return $this;
    }

    public function removeFlat(Flat $flat): self
    {
        $this->flat->removeElement($flat);

        return $this;
    }
}
