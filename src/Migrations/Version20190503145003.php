<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503145003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medicament ADD group_medicament_id INT NOT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723AF4E4AFB5 FOREIGN KEY (group_medicament_id) REFERENCES groups_medic (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723AF4E4AFB5 ON medicament (group_medicament_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723AF4E4AFB5');
        $this->addSql('DROP INDEX IDX_9A9C723AF4E4AFB5 ON medicament');
        $this->addSql('ALTER TABLE medicament DROP group_medicament_id');
    }
}
