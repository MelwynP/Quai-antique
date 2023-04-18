<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /* 
    #[Callback()]
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if ($this->getHourDejeuner() != '----' && $this->getHourDinner() != '----') {
            $context->buildViolation('Vous ne pouvez choisir qu\'une seule heure de réservation.')
            ->atPath('hourDejeuner')
            ->addViolation();
        }
    }
    */

    #[ORM\Column]
    private ?int $numberPeople = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $allergy = null;

    #[ORM\Column(length: 20)]
    private ?string $civility = null;

    #[ORM\Column(length: 100)]
    private ?string $firstname = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    private ?User $users = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column('capacity', type: Types::INTEGER, nullable: true)]
    private ?int $capacity = null;

    #[ORM\Column('capacity_available', type: Types::INTEGER, nullable: true)]
    private ?int $capacityAvailable = null;


    #[ORM\Column(length: 255)]
    private ?string $hourDejeuner = null;

    #[ORM\Column(length: 255)]
    private ?string $hourDinner = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHourDejeuner(): ?string
    {
        return $this->hourDejeuner;
    }

    public function setHourDejeuner(?string $hourDejeuner): self
    {
        $this->hourDejeuner = $hourDejeuner;

        return $this;
    }

    public function getHourDinner(): ?string
    {
        return $this->hourDinner;
    }

    public function setHourDinner(?string $hourDinner): self
    {
        $this->hourDinner = $hourDinner;

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

    public function getAllergy(): ?string
    {
        return $this->allergy;
    }

    public function setAllergy(?string $allergy): self
    {
        $this->allergy = $allergy;

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

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
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

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getCapacityAvailable(): ?int
    {
        return $this->capacityAvailable;
    }

    public function setCapacityAvailable(int $capacityAvailable): self
    {
        $this->capacityAvailable = $capacityAvailable;

        return $this;
    }
}
