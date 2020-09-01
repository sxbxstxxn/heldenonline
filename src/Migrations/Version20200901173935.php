<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200901173935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE character_skills (id INT AUTO_INCREMENT NOT NULL, charid_id INT NOT NULL, skillid_id INT NOT NULL, INDEX IDX_7673D5E352A49010 (charid_id), INDEX IDX_7673D5E3652072FE (skillid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_skills ADD CONSTRAINT FK_7673D5E352A49010 FOREIGN KEY (charid_id) REFERENCES chars (id)');
        $this->addSql('ALTER TABLE character_skills ADD CONSTRAINT FK_7673D5E3652072FE FOREIGN KEY (skillid_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE character_skills');
    }
}
