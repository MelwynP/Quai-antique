<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407080415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, date_reservation DATE NOT NULL, number_people INT NOT NULL, allergy LONGTEXT DEFAULT NULL, civility VARCHAR(20) NOT NULL, firstname VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, phone VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flats (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, photo_id INT NOT NULL, menus_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(4, 2) NOT NULL, INDEX IDX_6AEA002812469DE2 (category_id), INDEX IDX_6AEA00287E9E4C8C (photo_id), INDEX IDX_6AEA002814041B84 (menus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hour (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, day_week VARCHAR(100) NOT NULL, lunch_opening_time TIME DEFAULT NULL, lunch_closing_time TIME DEFAULT NULL, dinner_opening_time TIME DEFAULT NULL, dinner_closing_time TIME DEFAULT NULL, INDEX IDX_701E114EB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, average_price DOUBLE PRECISION NOT NULL, maximum_capacity INT NOT NULL, availability_capacity INT NOT NULL, number_table INT NOT NULL, number_chair INT NOT NULL, city VARCHAR(50) NOT NULL, zipcode INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, number_people INT NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', phone VARCHAR(255) NOT NULL, allergy VARCHAR(255) DEFAULT NULL, civility VARCHAR(20) NOT NULL, is_verified TINYINT(1) NOT NULL, reset_token VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flats ADD CONSTRAINT FK_6AEA002812469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE flats ADD CONSTRAINT FK_6AEA00287E9E4C8C FOREIGN KEY (photo_id) REFERENCES photos (id)');
        $this->addSql('ALTER TABLE flats ADD CONSTRAINT FK_6AEA002814041B84 FOREIGN KEY (menus_id) REFERENCES menus (id)');
        $this->addSql('ALTER TABLE hour ADD CONSTRAINT FK_701E114EB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flats DROP FOREIGN KEY FK_6AEA002812469DE2');
        $this->addSql('ALTER TABLE flats DROP FOREIGN KEY FK_6AEA00287E9E4C8C');
        $this->addSql('ALTER TABLE flats DROP FOREIGN KEY FK_6AEA002814041B84');
        $this->addSql('ALTER TABLE hour DROP FOREIGN KEY FK_701E114EB1E7706E');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE flats');
        $this->addSql('DROP TABLE hour');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
