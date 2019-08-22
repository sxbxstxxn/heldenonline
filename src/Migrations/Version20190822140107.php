<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190822140107 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP INDEX idx_user_username, ADD UNIQUE INDEX UNIQ_8D93D649F85E0677 (username)');
        $this->addSql('DROP INDEX idx_user_email ON user');
        $this->addSql('ALTER TABLE user DROP roles');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D649F85E0677, ADD INDEX idx_user_username (username)');
        $this->addSql('ALTER TABLE user ADD roles JSON DEFAULT NULL');
        $this->addSql('CREATE INDEX idx_user_email ON user (email)');
    }
}
