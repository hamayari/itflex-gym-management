<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126093606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY forgin key');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY events_ibfk_1');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY events_ibfk_2');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY participation_ibfk_2');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY participation_ibfk_1');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY post_ibfk_1');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_1');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('ALTER TABLE reservation_cours DROP FOREIGN KEY reservation_cours_ibfk_2');
        $this->addSql('DROP TABLE activites');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_magasin');
        $this->addSql('DROP TABLE categorieactivite');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reservation_cours');
        $this->addSql('DROP TABLE type_event');
        $this->addSql('ALTER TABLE user CHANGE VerificationCode verification_code INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activites (code INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, date_deb DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, id_user INT NOT NULL, salle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, titre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, idCategorie INT NOT NULL, INDEX id_user (id_user), INDEX idCategorie (idCategorie), PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (IdCategorie INT AUTO_INCREMENT NOT NULL, NomCategorie VARCHAR(255) CHARACTER SET armscii8 NOT NULL COLLATE `armscii8_general_ci`, DescriptionCategorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(IdCategorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_magasin (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorieactivite (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idUser INT NOT NULL, INDEX idUser (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE comment (idC INT AUTO_INCREMENT NOT NULL, idPost INT NOT NULL, content VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idUser INT NOT NULL, INDEX idUser (idUser), INDEX idPost (idPost), PRIMARY KEY(idC)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipement (IdEquipement INT AUTO_INCREMENT NOT NULL, NomEquipement VARCHAR(255) CHARACTER SET armscii8 NOT NULL COLLATE `armscii8_general_ci`, Quantite INT NOT NULL, DateAchat DATE NOT NULL, PrixAchat DOUBLE PRECISION NOT NULL, IdCategorie INT DEFAULT NULL, idUser INT NOT NULL, INDEX forgin key (IdCategorie), INDEX idUser (idUser), PRIMARY KEY(IdEquipement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE events (idtype INT NOT NULL, idEvent INT AUTO_INCREMENT NOT NULL, titreEvent VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nomCoach VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, typeEvent VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adresseEvent VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prixEvent DOUBLE PRECISION NOT NULL, dateEvent DATE NOT NULL, imgEvent VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nombrePlacesReservees INT NOT NULL, nombrePlacesTotal INT NOT NULL, idUser INT NOT NULL, INDEX idtype (idtype), INDEX idUser (idUser), PRIMARY KEY(idEvent)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participation (idPart INT AUTO_INCREMENT NOT NULL, idEvent INT NOT NULL, Nom VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Prenom VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Ntel VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, DatePart DATE NOT NULL, idUser INT NOT NULL, INDEX participation_ibfk_1 (idEvent), INDEX idUser (idUser), PRIMARY KEY(idPart)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post (idPost INT AUTO_INCREMENT NOT NULL, description VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, id_User INT NOT NULL, INDEX id_User (id_User), PRIMARY KEY(idPost)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit (id_prd INT AUTO_INCREMENT NOT NULL, idAdmin INT DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, description VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, categorie VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idCategorie INT NOT NULL, INDEX idCategorie (idCategorie), PRIMARY KEY(id_prd)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit_commande (id INT AUTO_INCREMENT NOT NULL, id_prd INT NOT NULL, id_cmd INT NOT NULL, INDEX id_cmd (id_cmd), INDEX id_prd (id_prd), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (Id INT AUTO_INCREMENT NOT NULL, Description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, IdUser INT NOT NULL, INDEX IdUser (IdUser), PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_cours (id INT AUTO_INCREMENT NOT NULL, code INT DEFAULT NULL, date_res DATETIME DEFAULT NULL, id_user INT NOT NULL, INDEX reservation_cours_ibfk_2 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_event (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT forgin key FOREIGN KEY (IdCategorie) REFERENCES categorie (IdCategorie)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT events_ibfk_1 FOREIGN KEY (idUser) REFERENCES user (Id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT events_ibfk_2 FOREIGN KEY (idtype) REFERENCES type_event (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT participation_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT participation_ibfk_1 FOREIGN KEY (idEvent) REFERENCES events (idEvent) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT post_ibfk_1 FOREIGN KEY (id_User) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_1 FOREIGN KEY (idCategorie) REFERENCES categorie_magasin (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (IdUser) REFERENCES user (Id)');
        $this->addSql('ALTER TABLE reservation_cours ADD CONSTRAINT reservation_cours_ibfk_2 FOREIGN KEY (code) REFERENCES activites (code)');
        $this->addSql('ALTER TABLE user CHANGE verification_code VerificationCode INT NOT NULL');
    }
}
