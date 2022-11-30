<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130132653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE indication (id INT AUTO_INCREMENT NOT NULL, traitement_id INT DEFAULT NULL, medicament_id INT DEFAULT NULL, posologie VARCHAR(255) NOT NULL, INDEX IDX_D15065D7DDA344B6 (traitement_id), INDEX IDX_D15065D7AB0D61F7 (medicament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sejour (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, datedebut DATE NOT NULL, datefin DATE NOT NULL, INDEX IDX_96F520286B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traitement (id INT AUTO_INCREMENT NOT NULL, sejour_id INT DEFAULT NULL, datedebut DATE NOT NULL, datefin DATE NOT NULL, INDEX IDX_2A356D2784CF0CF (sejour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE indication ADD CONSTRAINT FK_D15065D7DDA344B6 FOREIGN KEY (traitement_id) REFERENCES traitement (id)');
        $this->addSql('ALTER TABLE indication ADD CONSTRAINT FK_D15065D7AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F520286B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE traitement ADD CONSTRAINT FK_2A356D2784CF0CF FOREIGN KEY (sejour_id) REFERENCES sejour (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indication DROP FOREIGN KEY FK_D15065D7DDA344B6');
        $this->addSql('ALTER TABLE indication DROP FOREIGN KEY FK_D15065D7AB0D61F7');
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F520286B899279');
        $this->addSql('ALTER TABLE traitement DROP FOREIGN KEY FK_2A356D2784CF0CF');
        $this->addSql('DROP TABLE indication');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE sejour');
        $this->addSql('DROP TABLE traitement');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
