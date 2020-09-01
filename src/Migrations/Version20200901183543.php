<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200901183543 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, c_id INT NOT NULL, s_id INT NOT NULL, INDEX IDX_D531167091D79BD3 (c_id), INDEX IDX_D5311670C1CECC4C (s_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D531167091D79BD3 FOREIGN KEY (c_id) REFERENCES chars (id)');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D5311670C1CECC4C FOREIGN KEY (s_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE skills');
    }
}
