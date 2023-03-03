<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222104934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, name_association VARCHAR(255) NOT NULL, siren VARCHAR(255) NOT NULL, creation_date DATE DEFAULT NULL, email_association VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE party (id INT AUTO_INCREMENT NOT NULL, name_party VARCHAR(255) NOT NULL, player_max_party INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_api (id INT AUTO_INCREMENT NOT NULL, recordid VARCHAR(255) NOT NULL, caract122 INT NOT NULL, commune VARCHAR(255) NOT NULL, codepostal INT NOT NULL, nomequipement VARCHAR(255) DEFAULT NULL, coordgpsy VARCHAR(255) NOT NULL, coordgpsx VARCHAR(255) NOT NULL, caract20 TINYINT(1) DEFAULT NULL, address VARCHAR(255) NOT NULL, caract168 VARCHAR(255) DEFAULT NULL, caract167 VARCHAR(255) DEFAULT NULL, alreadyexist INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_details (id INT AUTO_INCREMENT NOT NULL, geohash_place VARCHAR(255) NOT NULL, image_place VARCHAR(255) NOT NULL, schedule_opening VARCHAR(255) DEFAULT NULL, schedule_closing VARCHAR(255) DEFAULT NULL, stillopen INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role_type INT NOT NULL, name_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, name_sport VARCHAR(255) NOT NULL, type_sport VARCHAR(255) NOT NULL, player_max_sport INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE party');
        $this->addSql('DROP TABLE place_api');
        $this->addSql('DROP TABLE place_details');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE sport');
    }
}
