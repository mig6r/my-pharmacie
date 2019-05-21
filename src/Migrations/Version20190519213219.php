<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190519213219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE locations (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, famille_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_17E64ABA727ACA70 (parent_id), INDEX IDX_17E64ABA97A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_17E64ABA727ACA70 FOREIGN KEY (parent_id) REFERENCES locations (id)');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_17E64ABA97A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE locations DROP FOREIGN KEY FK_17E64ABA727ACA70');
        $this->addSql('DROP TABLE locations');
    }
}
