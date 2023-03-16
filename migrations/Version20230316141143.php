<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316141143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, restaurant_id INT NOT NULL, date_reservation DATE NOT NULL, hour_reservation TIME NOT NULL, number_people INT NOT NULL, statut_reservation TINYINT(1) NOT NULL, commentary LONGTEXT DEFAULT NULL, allergy LONGTEXT DEFAULT NULL, INDEX IDX_E00CEDDEA76ED395 (user_id), INDEX IDX_E00CEDDEB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_flat (category_id INT NOT NULL, flat_id INT NOT NULL, INDEX IDX_DED1D00312469DE2 (category_id), INDEX IDX_DED1D003D3331C94 (flat_id), PRIMARY KEY(category_id, flat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flat (id INT AUTO_INCREMENT NOT NULL, photo_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price NUMERIC(3, 2) NOT NULL, ingredient VARCHAR(255) DEFAULT NULL, INDEX IDX_554AAA447E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hour (id INT AUTO_INCREMENT NOT NULL, day_week DATE NOT NULL, opening_time TIME NOT NULL, closing_day DATE NOT NULL, service_periode TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hour_restaurant (hour_id INT NOT NULL, restaurant_id INT NOT NULL, INDEX IDX_CDE320BB5937BF9 (hour_id), INDEX IDX_CDE320BB1E7706E (restaurant_id), PRIMARY KEY(hour_id, restaurant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(3, 2) NOT NULL, INDEX IDX_7D053A93B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, average_price DOUBLE PRECISION NOT NULL, maximum_capacity INT NOT NULL, availability_capacity INT NOT NULL, number_table INT NOT NULL, number_chair INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, allergy LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE category_flat ADD CONSTRAINT FK_DED1D00312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_flat ADD CONSTRAINT FK_DED1D003D3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flat ADD CONSTRAINT FK_554AAA447E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE hour_restaurant ADD CONSTRAINT FK_CDE320BB5937BF9 FOREIGN KEY (hour_id) REFERENCES hour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hour_restaurant ADD CONSTRAINT FK_CDE320BB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEB1E7706E');
        $this->addSql('ALTER TABLE category_flat DROP FOREIGN KEY FK_DED1D00312469DE2');
        $this->addSql('ALTER TABLE category_flat DROP FOREIGN KEY FK_DED1D003D3331C94');
        $this->addSql('ALTER TABLE flat DROP FOREIGN KEY FK_554AAA447E9E4C8C');
        $this->addSql('ALTER TABLE hour_restaurant DROP FOREIGN KEY FK_CDE320BB5937BF9');
        $this->addSql('ALTER TABLE hour_restaurant DROP FOREIGN KEY FK_CDE320BB1E7706E');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93B1E7706E');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_flat');
        $this->addSql('DROP TABLE flat');
        $this->addSql('DROP TABLE hour');
        $this->addSql('DROP TABLE hour_restaurant');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
