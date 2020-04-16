<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200416145126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE character_generalspecialskill (character_id INT NOT NULL, generalspecialskill_id INT NOT NULL, INDEX IDX_1A5F4F561136BE75 (character_id), INDEX IDX_1A5F4F568A5F3FD0 (generalspecialskill_id), PRIMARY KEY(character_id, generalspecialskill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generalspecialskill (id INT AUTO_INCREMENT NOT NULL, skillname VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_generalspecialskill ADD CONSTRAINT FK_1A5F4F561136BE75 FOREIGN KEY (character_id) REFERENCES chars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_generalspecialskill ADD CONSTRAINT FK_1A5F4F568A5F3FD0 FOREIGN KEY (generalspecialskill_id) REFERENCES generalspecialskill (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_generalspecialskill DROP FOREIGN KEY FK_1A5F4F568A5F3FD0');
        $this->addSql('DROP TABLE character_generalspecialskill');
        $this->addSql('DROP TABLE generalspecialskill');
    }
}
