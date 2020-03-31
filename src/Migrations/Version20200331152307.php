<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331152307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chars ADD birthplace VARCHAR(45) DEFAULT NULL, ADD birthdate VARCHAR(45) DEFAULT NULL, ADD age INT NOT NULL');
        $this->addSql('ALTER TABLE chars RENAME INDEX fk_species_idx TO IDX_7B32BF89B2A1D860');
        $this->addSql('ALTER TABLE chars RENAME INDEX fk_cultures_idx TO IDX_7B32BF89B108249D');
        $this->addSql('ALTER TABLE chars RENAME INDEX fk_profession_idx TO IDX_7B32BF89FDEF8996');
        $this->addSql('ALTER TABLE user CHANGE last_activity_at last_activity_at INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chars DROP birthplace, DROP birthdate, DROP age');
        $this->addSql('ALTER TABLE chars RENAME INDEX idx_7b32bf89b2a1d860 TO fk_species_idx');
        $this->addSql('ALTER TABLE chars RENAME INDEX idx_7b32bf89fdef8996 TO fk_profession_idx');
        $this->addSql('ALTER TABLE chars RENAME INDEX idx_7b32bf89b108249d TO fk_cultures_idx');
        $this->addSql('ALTER TABLE user CHANGE last_activity_at last_activity_at INT DEFAULT NULL');
    }
}
