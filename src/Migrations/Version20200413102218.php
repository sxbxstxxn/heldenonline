<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413102218 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chars ADD soulpowerbonus INT DEFAULT NULL, ADD soulpowermax INT DEFAULT NULL, ADD toughnessbonus INT DEFAULT NULL, ADD toughnessmax INT DEFAULT NULL, ADD dodgebonus INT DEFAULT NULL, ADD dodgemax INT DEFAULT NULL, ADD initiativebonus INT DEFAULT NULL, ADD initiativemax INT DEFAULT NULL, ADD speedbonus INT DEFAULT NULL, ADD speedmax INT DEFAULT NULL, ADD fatepointsbonus INT DEFAULT NULL, ADD fatepointsmax INT DEFAULT NULL, ADD fatepointscurrent INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chars DROP soulpowerbonus, DROP soulpowermax, DROP toughnessbonus, DROP toughnessmax, DROP dodgebonus, DROP dodgemax, DROP initiativebonus, DROP initiativemax, DROP speedbonus, DROP speedmax, DROP fatepointsbonus, DROP fatepointsmax, DROP fatepointscurrent');
    }
}
