<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316142025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_flat (menu_id INT NOT NULL, flat_id INT NOT NULL, INDEX IDX_9D055A0ACCD7E912 (menu_id), INDEX IDX_9D055A0AD3331C94 (flat_id), PRIMARY KEY(menu_id, flat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_flat ADD CONSTRAINT FK_9D055A0ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_flat ADD CONSTRAINT FK_9D055A0AD3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_flat DROP FOREIGN KEY FK_9D055A0ACCD7E912');
        $this->addSql('ALTER TABLE menu_flat DROP FOREIGN KEY FK_9D055A0AD3331C94');
        $this->addSql('DROP TABLE menu_flat');
    }
}
