<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223155337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_association (user_id INT NOT NULL, association_id INT NOT NULL, INDEX IDX_549EE859A76ED395 (user_id), INDEX IDX_549EE859EFB9C8A5 (association_id), PRIMARY KEY(user_id, association_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_association ADD CONSTRAINT FK_549EE859A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_association ADD CONSTRAINT FK_549EE859EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association ADD allow_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_FD8521CC3EC9F267 FOREIGN KEY (allow_id) REFERENCES manage_association (id)');
        $this->addSql('CREATE INDEX IDX_FD8521CC3EC9F267 ON association (allow_id)');
        $this->addSql('ALTER TABLE user ADD possess_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496F87E8F8 FOREIGN KEY (possess_id) REFERENCES manage_association (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496F87E8F8 ON user (possess_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_association DROP FOREIGN KEY FK_549EE859A76ED395');
        $this->addSql('ALTER TABLE user_association DROP FOREIGN KEY FK_549EE859EFB9C8A5');
        $this->addSql('DROP TABLE user_association');
        $this->addSql('ALTER TABLE association DROP FOREIGN KEY FK_FD8521CC3EC9F267');
        $this->addSql('DROP INDEX IDX_FD8521CC3EC9F267 ON association');
        $this->addSql('ALTER TABLE association DROP allow_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496F87E8F8');
        $this->addSql('DROP INDEX IDX_8D93D6496F87E8F8 ON user');
        $this->addSql('ALTER TABLE user DROP possess_id');
    }
}
