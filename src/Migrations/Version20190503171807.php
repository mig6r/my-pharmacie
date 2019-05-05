<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503171807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('ALTER TABLE user_infos ADD famille_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_infos ADD CONSTRAINT FK_C08793597A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('CREATE INDEX IDX_C08793597A77B84 ON user_infos (famille_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_infos DROP FOREIGN KEY FK_C08793597A77B84');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP INDEX IDX_C08793597A77B84 ON user_infos');
        $this->addSql('ALTER TABLE user_infos DROP famille_id');
    }
}
