<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223150328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manage_association (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, validate INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport_place_api (sport_id INT NOT NULL, place_api_id INT NOT NULL, INDEX IDX_89354693AC78BCF8 (sport_id), INDEX IDX_89354693F6583E51 (place_api_id), PRIMARY KEY(sport_id, place_api_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sport_place_api ADD CONSTRAINT FK_89354693AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sport_place_api ADD CONSTRAINT FK_89354693F6583E51 FOREIGN KEY (place_api_id) REFERENCES place_api (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE party ADD user_id INT DEFAULT NULL, ADD sport_id INT DEFAULT NULL, ADD place_api_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE party ADD CONSTRAINT FK_89954EE0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE party ADD CONSTRAINT FK_89954EE0AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE party ADD CONSTRAINT FK_89954EE0F6583E51 FOREIGN KEY (place_api_id) REFERENCES place_api (id)');
        $this->addSql('CREATE INDEX IDX_89954EE0A76ED395 ON party (user_id)');
        $this->addSql('CREATE INDEX IDX_89954EE0AC78BCF8 ON party (sport_id)');
        $this->addSql('CREATE INDEX IDX_89954EE0F6583E51 ON party (place_api_id)');
        $this->addSql('ALTER TABLE place_api ADD provide_id INT NOT NULL');
        $this->addSql('ALTER TABLE place_api ADD CONSTRAINT FK_A2B7BEFE9B54C5B7 FOREIGN KEY (provide_id) REFERENCES place_details (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2B7BEFE9B54C5B7 ON place_api (provide_id)');
        $this->addSql('ALTER TABLE role ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_57698A6A67B3B43D ON role (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sport_place_api DROP FOREIGN KEY FK_89354693AC78BCF8');
        $this->addSql('ALTER TABLE sport_place_api DROP FOREIGN KEY FK_89354693F6583E51');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('DROP TABLE manage_association');
        $this->addSql('DROP TABLE sport_place_api');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('ALTER TABLE place_api DROP FOREIGN KEY FK_A2B7BEFE9B54C5B7');
        $this->addSql('DROP INDEX UNIQ_A2B7BEFE9B54C5B7 ON place_api');
        $this->addSql('ALTER TABLE place_api DROP provide_id');
        $this->addSql('ALTER TABLE party DROP FOREIGN KEY FK_89954EE0A76ED395');
        $this->addSql('ALTER TABLE party DROP FOREIGN KEY FK_89954EE0AC78BCF8');
        $this->addSql('ALTER TABLE party DROP FOREIGN KEY FK_89954EE0F6583E51');
        $this->addSql('DROP INDEX IDX_89954EE0A76ED395 ON party');
        $this->addSql('DROP INDEX IDX_89954EE0AC78BCF8 ON party');
        $this->addSql('DROP INDEX IDX_89954EE0F6583E51 ON party');
        $this->addSql('ALTER TABLE party DROP user_id, DROP sport_id, DROP place_api_id');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A67B3B43D');
        $this->addSql('DROP INDEX IDX_57698A6A67B3B43D ON role');
        $this->addSql('ALTER TABLE role DROP users_id');
    }
}
