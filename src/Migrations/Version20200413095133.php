<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413095133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chars ADD astralenergy INT DEFAULT NULL, ADD astralenergybonus INT DEFAULT NULL, ADD astralenergypurchase INT DEFAULT NULL, ADD astralenergymax INT DEFAULT NULL, ADD karmaenergy INT DEFAULT NULL, ADD karmaenergybonus INT DEFAULT NULL, ADD karmaenergypurchase INT DEFAULT NULL, ADD karmaenergymax INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chars DROP astralenergy, DROP astralenergybonus, DROP astralenergypurchase, DROP astralenergymax, DROP karmaenergy, DROP karmaenergybonus, DROP karmaenergypurchase, DROP karmaenergymax');
    }
}
