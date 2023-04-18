<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418182743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD hour VARCHAR(255) DEFAULT NULL, ADD service VARCHAR(255) NOT NULL, DROP hour_dejeuner, DROP hour_dinner');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD hour_dinner VARCHAR(255) DEFAULT NULL, DROP service, CHANGE hour hour_dejeuner VARCHAR(255) DEFAULT NULL');
    }
}
