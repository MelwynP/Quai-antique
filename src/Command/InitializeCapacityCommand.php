<?php

namespace App\Command;

use App\Entity\Capacity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitializeCapacityCommand extends Command
{
  protected static $defaultName = 'app:initialize-capacity';

  private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
    parent::__construct();
  }

  protected function configure()
  {
    $this
      ->setDescription('Initialize capacity for lunch and dinner')
      ->setHelp('This command initializes capacity for lunch and dinner.');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $capacity = new Capacity();
    $capacity->setCapacityMaxLunch(60);
    $capacity->setCapacityMaxDinner(60);
    $capacity->setCapacityAvailableLunch(60);
    $capacity->setCapacityAvailableDinner(60);


    $this->em->persist($capacity);
    $this->em->flush();

    $output->writeln('Capacity initialized.');

    return Command::SUCCESS;
  }
}
