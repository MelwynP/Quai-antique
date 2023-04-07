<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230406231737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flats ADD photo_id INT NOT NULL');
        $this->addSql('ALTER TABLE flats ADD CONSTRAINT FK_6AEA00287E9E4C8C FOREIGN KEY (photo_id) REFERENCES photos (id)');
        $this->addSql('CREATE INDEX IDX_6AEA00287E9E4C8C ON flats (photo_id)');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9D3331C94');
        $this->addSql('DROP INDEX IDX_876E0D9D3331C94 ON photos');
        $this->addSql('ALTER TABLE photos DROP flat_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flats DROP FOREIGN KEY FK_6AEA00287E9E4C8C');
        $this->addSql('DROP INDEX IDX_6AEA00287E9E4C8C ON flats');
        $this->addSql('ALTER TABLE flats DROP photo_id');
        $this->addSql('ALTER TABLE photos ADD flat_id INT NOT NULL');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9D3331C94 FOREIGN KEY (flat_id) REFERENCES flats (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_876E0D9D3331C94 ON photos (flat_id)');
    }
}
