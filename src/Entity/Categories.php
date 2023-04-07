<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Flats::class)]
    private Collection $fLats;

    public function __construct()
    {
        $this->fLats = new ArrayCollection();
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

    /**
     * @return Collection<int, Flats>
     */
    public function getFlats(): Collection
    {
        return $this->fLats;
    }

    public function addFlat(Flats $fLat): self
    {
        if (!$this->fLats->contains($fLat)) {
            $this->fLats->add($fLat);
            $fLat->setCategory($this);
        }

        return $this;
    }

    public function removeFlat(Flats $fLat): self
    {
        if ($this->fLats->removeElement($fLat)) {
            // set the owning side to null (unless already changed)
            if ($fLat->getCategory() === $this) {
                $fLat->setCategory(null);
            }
        }

        return $this;
    }
}
