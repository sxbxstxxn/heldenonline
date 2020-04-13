<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413155703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE character_advantage (character_id INT NOT NULL, advantage_id INT NOT NULL, INDEX IDX_AEDE839A1136BE75 (character_id), INDEX IDX_AEDE839A3864498A (advantage_id), PRIMARY KEY(character_id, advantage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_advantage ADD CONSTRAINT FK_AEDE839A1136BE75 FOREIGN KEY (character_id) REFERENCES chars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_advantage ADD CONSTRAINT FK_AEDE839A3864498A FOREIGN KEY (advantage_id) REFERENCES advantage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE character_advantage');
    }
}
