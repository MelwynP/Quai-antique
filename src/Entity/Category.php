<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Flat::class)]
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

    /**
     * @return Collection<int, Flat>
     */
    public function getFlats(): Collection
    {
        return $this->flats;
    }

    public function addFlat(Flat $flat): self
    {
        if (!$this->flats->contains($flat)) {
            $this->flats->add($flat);
            $flat->setCategory($this);
        }

        return $this;
    }

    public function removeFlat(Flat $flat): self
    {
        if ($this->flats->removeElement($flat)) {
            // set the owning side to null (unless already changed)
            if ($flat->getCategory() === $this) {
                $flat->setCategory(null);
            }
        }

        return $this;
    }
}
