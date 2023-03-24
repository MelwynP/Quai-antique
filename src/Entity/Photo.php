<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;
    
    #[ORM\OneToMany(mappedBy: 'photo', targetEntity: Flat::class, orphanRemoval: true)]
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

    public function getFile(): ?string
    {
        return $this->file;
    }
    
    public function setFile(string $file): self
    {
        $this->file = $file;
        
        return $this;
    }
    
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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
            $flat->setPhoto($this);
        }

        return $this;
    }

    public function removeFlat(Flat $flat): self
    {
        if ($this->flat->removeElement($flat)) {
            // set the owning side to null (unless already changed)
            if ($flat->getPhoto() === $this) {
                $flat->setPhoto(null);
            }
        }

        return $this;
    }

}
