<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316143744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flat ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE flat ADD CONSTRAINT FK_554AAA44B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_554AAA44B1E7706E ON flat (restaurant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flat DROP FOREIGN KEY FK_554AAA44B1E7706E');
        $this->addSql('DROP INDEX IDX_554AAA44B1E7706E ON flat');
        $this->addSql('ALTER TABLE flat DROP restaurant_id');
    }
}
