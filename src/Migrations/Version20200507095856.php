<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507095856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transport_destination (transport_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_A8A8DDAD9909C13F (transport_id), INDEX IDX_A8A8DDAD816C6140 (destination_id), PRIMARY KEY(transport_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transport_destination ADD CONSTRAINT FK_A8A8DDAD9909C13F FOREIGN KEY (transport_id) REFERENCES transport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transport_destination ADD CONSTRAINT FK_A8A8DDAD816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transport_destination');
    }
}
