<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190505130903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cat_medicaments ADD famille_id INT NOT NULL');
        $this->addSql('ALTER TABLE cat_medicaments ADD CONSTRAINT FK_17FFAA6A97A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('CREATE INDEX IDX_17FFAA6A97A77B84 ON cat_medicaments (famille_id)');
        $this->addSql('ALTER TABLE symptome ADD famille_id INT NOT NULL');
        $this->addSql('ALTER TABLE symptome ADD CONSTRAINT FK_39E81B4297A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('CREATE INDEX IDX_39E81B4297A77B84 ON symptome (famille_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cat_medicaments DROP FOREIGN KEY FK_17FFAA6A97A77B84');
        $this->addSql('DROP INDEX IDX_17FFAA6A97A77B84 ON cat_medicaments');
        $this->addSql('ALTER TABLE cat_medicaments DROP famille_id');
        $this->addSql('ALTER TABLE symptome DROP FOREIGN KEY FK_39E81B4297A77B84');
        $this->addSql('DROP INDEX IDX_39E81B4297A77B84 ON symptome');
        $this->addSql('ALTER TABLE symptome DROP famille_id');
    }
}
