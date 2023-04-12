<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: Flat::class)]
    private Collection $flats;

    public function __construct()
    {
        $this->flats = new ArrayCollection();
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
        return $this->flats;
    }

    public function addFlat(Flat $flat): self
    {
        if (!$this->flats->contains($flat)) {
            $this->flats->add($flat);
            $flat->setMenu($this);
        }

        return $this;
    }

    public function removeFlat(Flat $flat): self
    {
        if ($this->flats->removeElement($flat)) {
            // set the owning side to null (unless already changed)
            if ($flat->getMenu() === $this) {
                $flat->setMenu(null);
            }
        }

        return $this;
    }
}
