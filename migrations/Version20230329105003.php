<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329105003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, num_compte VARCHAR(12) NOT NULL, iban VARCHAR(27) NOT NULL, titre VARCHAR(15) NOT NULL, code_banque VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE virement_entrant (id INT AUTO_INCREMENT NOT NULL, compte_beneficiaire_id INT NOT NULL, date DATETIME NOT NULL, montant DOUBLE PRECISION NOT NULL, iban_emetteur VARCHAR(27) NOT NULL, INDEX IDX_F6D3BC0693345638 (compte_beneficiaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE virement_sortant (id INT AUTO_INCREMENT NOT NULL, compte_emetteur_id INT NOT NULL, date DATETIME NOT NULL, iban_destinataire VARCHAR(27) NOT NULL, INDEX IDX_93AA6C2B55F8A4D8 (compte_emetteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE virement_entrant ADD CONSTRAINT FK_F6D3BC0693345638 FOREIGN KEY (compte_beneficiaire_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE virement_sortant ADD CONSTRAINT FK_93AA6C2B55F8A4D8 FOREIGN KEY (compte_emetteur_id) REFERENCES compte (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE virement_entrant DROP FOREIGN KEY FK_F6D3BC0693345638');
        $this->addSql('ALTER TABLE virement_sortant DROP FOREIGN KEY FK_93AA6C2B55F8A4D8');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE virement_entrant');
        $this->addSql('DROP TABLE virement_sortant');
    }
}
