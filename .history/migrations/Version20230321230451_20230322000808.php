<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321230451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent_immobilier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien_immobilier (id INT AUTO_INCREMENT NOT NULL, propreitaire_id INT NOT NULL, agent_immobilier_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, taille INT NOT NULL, prix INT NOT NULL, INDEX IDX_D1BE34E18ACD1DD0 (propreitaire_id), INDEX IDX_D1BE34E150BBCE1E (agent_immobilier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat_location (id INT AUTO_INCREMENT NOT NULL, locataire_id INT NOT NULL, code VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, loyer_mensuel DOUBLE PRECISION NOT NULL, montant_guarrantie DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_E7519391D8A38199 (locataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depense (id INT AUTO_INCREMENT NOT NULL, bien_immobilier_id INT DEFAULT NULL, date DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_340597575992120A (bien_immobilier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, locataire_id INT DEFAULT NULL, date_emission DATE NOT NULL, date_delai DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_FE866410D8A38199 (locataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, propreitaire_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, numero VARCHAR(255) NOT NULL, INDEX IDX_C47CF6EB8ACD1DD0 (propreitaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE propreitaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revenu (id INT AUTO_INCREMENT NOT NULL, bien_immobilier_id INT DEFAULT NULL, date DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_7DA3C0455992120A (bien_immobilier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien_immobilier ADD CONSTRAINT FK_D1BE34E18ACD1DD0 FOREIGN KEY (propreitaire_id) REFERENCES propreitaire (id)');
        $this->addSql('ALTER TABLE bien_immobilier ADD CONSTRAINT FK_D1BE34E150BBCE1E FOREIGN KEY (agent_immobilier_id) REFERENCES agent_immobilier (id)');
        $this->addSql('ALTER TABLE contrat_location ADD CONSTRAINT FK_E7519391D8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_340597575992120A FOREIGN KEY (bien_immobilier_id) REFERENCES bien_immobilier (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410D8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EB8ACD1DD0 FOREIGN KEY (propreitaire_id) REFERENCES propreitaire (id)');
        $this->addSql('ALTER TABLE revenu ADD CONSTRAINT FK_7DA3C0455992120A FOREIGN KEY (bien_immobilier_id) REFERENCES bien_immobilier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien_immobilier DROP FOREIGN KEY FK_D1BE34E18ACD1DD0');
        $this->addSql('ALTER TABLE bien_immobilier DROP FOREIGN KEY FK_D1BE34E150BBCE1E');
        $this->addSql('ALTER TABLE contrat_location DROP FOREIGN KEY FK_E7519391D8A38199');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_340597575992120A');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410D8A38199');
        $this->addSql('ALTER TABLE locataire DROP FOREIGN KEY FK_C47CF6EB8ACD1DD0');
        $this->addSql('ALTER TABLE revenu DROP FOREIGN KEY FK_7DA3C0455992120A');
        $this->addSql('DROP TABLE agent_immobilier');
        $this->addSql('DROP TABLE bien_immobilier');
        $this->addSql('DROP TABLE contrat_location');
        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE propreitaire');
        $this->addSql('DROP TABLE revenu');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
