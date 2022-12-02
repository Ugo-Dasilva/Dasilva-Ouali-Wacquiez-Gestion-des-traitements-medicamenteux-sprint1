<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202090747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE effetsecondaire_medicament (effetsecondaire_id INT NOT NULL, medicament_id INT NOT NULL, INDEX IDX_7AC74955D2944437 (effetsecondaire_id), INDEX IDX_7AC74955AB0D61F7 (medicament_id), PRIMARY KEY(effetsecondaire_id, medicament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmaciens (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3FE38F3BE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE effetsecondaire_medicament ADD CONSTRAINT FK_7AC74955D2944437 FOREIGN KEY (effetsecondaire_id) REFERENCES effetsecondaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE effetsecondaire_medicament ADD CONSTRAINT FK_7AC74955AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE effet_secondaire_medicament DROP FOREIGN KEY FK_E63A19A4AB0D61F7');
        $this->addSql('ALTER TABLE effet_secondaire_medicament DROP FOREIGN KEY FK_E63A19A4860A3B91');
        $this->addSql('DROP TABLE effet_secondaire');
        $this->addSql('DROP TABLE effet_secondaire_medicament');
        $this->addSql('DROP TABLE pharmacien');
        $this->addSql('ALTER TABLE infirmier ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFEC55B9E7927C74 ON infirmier (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE effet_secondaire (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE effet_secondaire_medicament (effet_secondaire_id INT NOT NULL, medicament_id INT NOT NULL, INDEX IDX_E63A19A4AB0D61F7 (medicament_id), INDEX IDX_E63A19A4860A3B91 (effet_secondaire_id), PRIMARY KEY(effet_secondaire_id, medicament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pharmacien (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE effet_secondaire_medicament ADD CONSTRAINT FK_E63A19A4AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE effet_secondaire_medicament ADD CONSTRAINT FK_E63A19A4860A3B91 FOREIGN KEY (effet_secondaire_id) REFERENCES effet_secondaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE effetsecondaire_medicament DROP FOREIGN KEY FK_7AC74955D2944437');
        $this->addSql('ALTER TABLE effetsecondaire_medicament DROP FOREIGN KEY FK_7AC74955AB0D61F7');
        $this->addSql('DROP TABLE effetsecondaire_medicament');
        $this->addSql('DROP TABLE pharmaciens');
        $this->addSql('DROP INDEX UNIQ_BFEC55B9E7927C74 ON infirmier');
        $this->addSql('ALTER TABLE infirmier DROP email, DROP roles, DROP password');
    }
}
