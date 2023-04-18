<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418085751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD hour_dejeuner TIME NOT NULL, ADD hour_dinner TIME NOT NULL, DROP hour_reservation, DROP service, CHANGE number_people number_people INT NOT NULL, CHANGE capacity capacity INT NOT NULL, CHANGE capacity_available capacity_available INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD hour_reservation VARCHAR(100) DEFAULT NULL, ADD service VARCHAR(255) DEFAULT NULL, DROP hour_dejeuner, DROP hour_dinner, CHANGE number_people number_people INT DEFAULT NULL, CHANGE capacity capacity INT DEFAULT NULL, CHANGE capacity_available capacity_available INT DEFAULT NULL');
    }
}
