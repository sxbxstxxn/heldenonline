<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200416142632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE disadvantage (id INT AUTO_INCREMENT NOT NULL, disadvantagename VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_disadvantage (character_id INT NOT NULL, disadvantage_id INT NOT NULL, INDEX IDX_7685B7581136BE75 (character_id), INDEX IDX_7685B7587995CCA1 (disadvantage_id), PRIMARY KEY(character_id, disadvantage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_disadvantage ADD CONSTRAINT FK_7685B7581136BE75 FOREIGN KEY (character_id) REFERENCES chars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_disadvantage ADD CONSTRAINT FK_7685B7587995CCA1 FOREIGN KEY (disadvantage_id) REFERENCES disadvantage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_disadvantage DROP FOREIGN KEY FK_7685B7587995CCA1');
        $this->addSql('DROP TABLE disadvantage');
        $this->addSql('DROP TABLE character_disadvantage');
    }
}
