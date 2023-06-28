<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627080344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, sujet VARCHAR(255) DEFAULT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie CHANGE name name VARCHAR(100) NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE commande CHANGE adresse_livraison adresse_livraison VARCHAR(255) NOT NULL COLLATE `utf8_general_ci`, CHANGE ville ville VARCHAR(255) NOT NULL COLLATE `utf8_general_ci`, CHANGE complement_adress complement_adress VARCHAR(255) DEFAULT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE produit CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8_general_ci`, CHANGE poids poids VARCHAR(100) NOT NULL COLLATE `utf8_general_ci`, CHANGE photo photo VARCHAR(255) NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(50) NOT NULL COLLATE `utf8_general_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8_general_ci`, CHANGE code_postal code_postal VARCHAR(50) NOT NULL COLLATE `utf8_general_ci`, CHANGE adresse adresse VARCHAR(50) NOT NULL COLLATE `utf8_general_ci`, CHANGE complement_adresse complement_adresse VARCHAR(50) DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE ville ville VARCHAR(50) NOT NULL COLLATE `utf8_general_ci`, CHANGE nom nom VARCHAR(50) NOT NULL COLLATE `utf8_general_ci`, CHANGE prenom prenom VARCHAR(50) NOT NULL COLLATE `utf8_general_ci`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE categorie CHANGE name name VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE commande CHANGE adresse_livraison adresse_livraison VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE ville ville VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE complement_adress complement_adress VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE produit CHANGE nom nom VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE poids poids VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE `user` CHANGE email email VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE password password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE code_postal code_postal VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE adresse adresse VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE complement_adresse complement_adresse VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE ville ville VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE nom nom VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE prenom prenom VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
