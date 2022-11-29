<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129141424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indication ADD traitement_id INT DEFAULT NULL, ADD medicament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE indication ADD CONSTRAINT FK_D15065D7DDA344B6 FOREIGN KEY (traitement_id) REFERENCES traitement (id)');
        $this->addSql('ALTER TABLE indication ADD CONSTRAINT FK_D15065D7AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('CREATE INDEX IDX_D15065D7DDA344B6 ON indication (traitement_id)');
        $this->addSql('CREATE INDEX IDX_D15065D7AB0D61F7 ON indication (medicament_id)');
        $this->addSql('ALTER TABLE sejour ADD patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F520286B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_96F520286B899279 ON sejour (patient_id)');
        $this->addSql('ALTER TABLE traitement ADD sejour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traitement ADD CONSTRAINT FK_2A356D2784CF0CF FOREIGN KEY (sejour_id) REFERENCES sejour (id)');
        $this->addSql('CREATE INDEX IDX_2A356D2784CF0CF ON traitement (sejour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indication DROP FOREIGN KEY FK_D15065D7DDA344B6');
        $this->addSql('ALTER TABLE indication DROP FOREIGN KEY FK_D15065D7AB0D61F7');
        $this->addSql('DROP INDEX IDX_D15065D7DDA344B6 ON indication');
        $this->addSql('DROP INDEX IDX_D15065D7AB0D61F7 ON indication');
        $this->addSql('ALTER TABLE indication DROP traitement_id, DROP medicament_id');
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F520286B899279');
        $this->addSql('DROP INDEX IDX_96F520286B899279 ON sejour');
        $this->addSql('ALTER TABLE sejour DROP patient_id');
        $this->addSql('ALTER TABLE traitement DROP FOREIGN KEY FK_2A356D2784CF0CF');
        $this->addSql('DROP INDEX IDX_2A356D2784CF0CF ON traitement');
        $this->addSql('ALTER TABLE traitement DROP sejour_id');
    }
}
