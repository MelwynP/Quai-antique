<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\DBAL\Types\Types;
//use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
//#[ApiResource]

class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'La date de réservation est obligatoire')]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Le type de service est obligatoire')]
    private ?string $serviceType = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'L\'heure de réservation est obligatoire')]
    private ?string $hour = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le nombre de personnes est obligatoire')]
    private ?int $numberPeople = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: 'La civilité est obligatoire')]
    private ?string $civility = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    #[Assert\Length(min: 2, max: 80, minMessage: 'Le nom doit contenir au moins {{ limit }} caractères', maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères')]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Assert\Length(min: 2, max: 80, minMessage: 'Le prénom doit contenir au moins {{ limit }} caractères', maxMessage: 'Le prénom doit contenir au maximum {{ limit }} caractères')]
    private ?string $firstname = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Assert\Length(max: 10, maxMessage: 'Le numéro de téléphone est optionnel mais il doit contenir {{ limit }} chiffres')]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'L\'adresse email est obligatoire')]
    #[Assert\Email(message: 'L\'adresse email n\'est pas valide')]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(max: 200, maxMessage: 'Le champ allergie(s) est optionnel mais il doit contenir au maximum {{ limit }} caractères')]
    private ?string $allergy = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    private ?User $users = null;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getServiceType(): ?string
    {
        return $this->serviceType;
    }

    public function setServiceType(?string $serviceType): self
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(?string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getNumberPeople(): ?int
    {
        return $this->numberPeople;
    }

    public function setNumberPeople(int $numberPeople): self
    {
        $this->numberPeople = $numberPeople;

        return $this;
    }

    public function getCivility(): ?string
    {
        return $this->civility;
    }

    public function setCivility(string $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAllergy(): ?string
    {
        return $this->allergy;
    }

    public function setAllergy(?string $allergy): self
    {
        $this->allergy = $allergy;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }
}
