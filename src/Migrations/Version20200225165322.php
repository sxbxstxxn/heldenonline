<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225165322 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE registration_hash registration_hash VARCHAR(255) NOT NULL, CHANGE registration_confirmed registration_confirmed INT NOT NULL, CHANGE last_activity_at last_activity_at INT NOT NULL');
        $this->addSql('ALTER TABLE chars ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE chars ADD CONSTRAINT FK_7B32BF89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7B32BF89A76ED395 ON chars (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chars DROP FOREIGN KEY FK_7B32BF89A76ED395');
        $this->addSql('DROP INDEX IDX_7B32BF89A76ED395 ON chars');
        $this->addSql('ALTER TABLE chars DROP user_id');
        $this->addSql('ALTER TABLE user CHANGE registration_hash registration_hash VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE registration_confirmed registration_confirmed INT DEFAULT NULL, CHANGE last_activity_at last_activity_at INT DEFAULT NULL');
    }
}
