<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190430071810 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE medicament_symptome (medicament_id INT NOT NULL, symptome_id INT NOT NULL, INDEX IDX_D6D7ABEEAB0D61F7 (medicament_id), INDEX IDX_D6D7ABEE12B83D77 (symptome_id), PRIMARY KEY(medicament_id, symptome_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE symptome (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medicament_symptome ADD CONSTRAINT FK_D6D7ABEEAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicament_symptome ADD CONSTRAINT FK_D6D7ABEE12B83D77 FOREIGN KEY (symptome_id) REFERENCES symptome (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medicament_symptome DROP FOREIGN KEY FK_D6D7ABEE12B83D77');
        $this->addSql('DROP TABLE medicament_symptome');
        $this->addSql('DROP TABLE symptome');
    }
}
