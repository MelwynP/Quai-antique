<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class BookingService
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  private function getAvailableHours(string $period): array
  {
    $hours = [];
    $startHour = $period === 'midi' ? 12 : 19;
    $endHour = $period === 'midi' ? 14 : 22;
    $interval = new \DateInterval('PT15M'); // interval of 15 minutes
    $currentTime = new \DateTimeImmutable("$startHour:00");

    while ($currentTime <= new \DateTimeImmutable("$endHour:00")) {
        $hours[$currentTime->format('H:i')] = $currentTime->format('H\hi');
        $currentTime = $currentTime->add($interval);
    }

    return $hours;
}
}