<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190508202845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cat_medicaments (id INT AUTO_INCREMENT NOT NULL, famille_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_17FFAA6A97A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille (id INT AUTO_INCREMENT NOT NULL, admin_id INT NOT NULL, name VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, INDEX IDX_2473F213642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups_medic (id INT AUTO_INCREMENT NOT NULL, famille_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D581A78497A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, cat_medicament_id INT DEFAULT NULL, group_medicament_id INT DEFAULT NULL, famille_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, notice VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, enable TINYINT(1) NOT NULL, commentaires LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_9A9C723A277F06F0 (cat_medicament_id), INDEX IDX_9A9C723AF4E4AFB5 (group_medicament_id), INDEX IDX_9A9C723A97A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament_symptome (medicament_id INT NOT NULL, symptome_id INT NOT NULL, INDEX IDX_D6D7ABEEAB0D61F7 (medicament_id), INDEX IDX_D6D7ABEE12B83D77 (symptome_id), PRIMARY KEY(medicament_id, symptome_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE symptome (id INT AUTO_INCREMENT NOT NULL, famille_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_39E81B4297A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, famille_id INT DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64997A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_infos (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C087935A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cat_medicaments ADD CONSTRAINT FK_17FFAA6A97A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE famille ADD CONSTRAINT FK_2473F213642B8210 FOREIGN KEY (admin_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE groups_medic ADD CONSTRAINT FK_D581A78497A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A277F06F0 FOREIGN KEY (cat_medicament_id) REFERENCES cat_medicaments (id)');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723AF4E4AFB5 FOREIGN KEY (group_medicament_id) REFERENCES groups_medic (id)');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A97A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE medicament_symptome ADD CONSTRAINT FK_D6D7ABEEAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicament_symptome ADD CONSTRAINT FK_D6D7ABEE12B83D77 FOREIGN KEY (symptome_id) REFERENCES symptome (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE symptome ADD CONSTRAINT FK_39E81B4297A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64997A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE user_infos ADD CONSTRAINT FK_C087935A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A277F06F0');
        $this->addSql('ALTER TABLE cat_medicaments DROP FOREIGN KEY FK_17FFAA6A97A77B84');
        $this->addSql('ALTER TABLE groups_medic DROP FOREIGN KEY FK_D581A78497A77B84');
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A97A77B84');
        $this->addSql('ALTER TABLE symptome DROP FOREIGN KEY FK_39E81B4297A77B84');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64997A77B84');
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723AF4E4AFB5');
        $this->addSql('ALTER TABLE medicament_symptome DROP FOREIGN KEY FK_D6D7ABEEAB0D61F7');
        $this->addSql('ALTER TABLE medicament_symptome DROP FOREIGN KEY FK_D6D7ABEE12B83D77');
        $this->addSql('ALTER TABLE famille DROP FOREIGN KEY FK_2473F213642B8210');
        $this->addSql('ALTER TABLE user_infos DROP FOREIGN KEY FK_C087935A76ED395');
        $this->addSql('DROP TABLE cat_medicaments');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP TABLE groups_medic');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE medicament_symptome');
        $this->addSql('DROP TABLE symptome');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_infos');
    }
}
