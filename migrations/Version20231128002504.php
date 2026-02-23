<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128002504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY forgin key');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY equipement_ibfk_1');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY events_ibfk_1');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY events_ibfk_2');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY participation_ibfk_2');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY participation_ibfk_1');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY produit_ibfk_1');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('ALTER TABLE reservation_cours DROP FOREIGN KEY reservation_cours_ibfk_2');
        $this->addSql('ALTER TABLE reservation_offer DROP FOREIGN KEY reservation_offer_ibfk_1');
        $this->addSql('ALTER TABLE reservation_offer DROP FOREIGN KEY reservation_offer_ibfk_2');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE activites');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorieactivite');
        $this->addSql('DROP TABLE categorie_magasin');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reservation_cours');
        $this->addSql('DROP TABLE reservation_offer');
        $this->addSql('DROP TABLE type_abonn');
        $this->addSql('DROP TABLE type_event');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_1');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_2');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_1');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_2');
        $this->addSql('ALTER TABLE comment CHANGE content content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C29773213 FOREIGN KEY (idPost) REFERENCES post (idPost) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX idpost ON comment');
        $this->addSql('CREATE INDEX IDX_9474526C29773213 ON comment (idPost)');
        $this->addSql('DROP INDEX iduser ON comment');
        $this->addSql('CREATE INDEX IDX_9474526CFE6E88D7 ON comment (idUser)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT comment_ibfk_1 FOREIGN KEY (idPost) REFERENCES post (idPost) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT comment_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id)');
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY dislikes_ibfk_1');
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY dislikes_ibfk_2');
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY dislikes_ibfk_1');
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY dislikes_ibfk_2');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT FK_2DF3BE1129773213 FOREIGN KEY (idPost) REFERENCES post (idPost) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT FK_2DF3BE11FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX idpost ON dislikes');
        $this->addSql('CREATE INDEX IDX_2DF3BE1129773213 ON dislikes (idPost)');
        $this->addSql('DROP INDEX iduser ON dislikes');
        $this->addSql('CREATE INDEX IDX_2DF3BE11FE6E88D7 ON dislikes (idUser)');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT dislikes_ibfk_1 FOREIGN KEY (idPost) REFERENCES post (idPost) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT dislikes_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY likes_ibfk_1');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY likes_ibfk_2');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY likes_ibfk_1');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY likes_ibfk_2');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D29773213 FOREIGN KEY (idPost) REFERENCES post (idPost) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX idpost ON likes');
        $this->addSql('CREATE INDEX IDX_49CA4E7D29773213 ON likes (idPost)');
        $this->addSql('DROP INDEX iduser ON likes');
        $this->addSql('CREATE INDEX IDX_49CA4E7DFE6E88D7 ON likes (idUser)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT likes_ibfk_1 FOREIGN KEY (idPost) REFERENCES post (idPost) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT likes_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY post_ibfk_1');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY post_ibfk_1');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX id_user ON post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DFE6E88D7 ON post (idUser)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT post_ibfk_1 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (idAbonement INT AUTO_INCREMENT NOT NULL, dateAbonnement DATE NOT NULL, typeAbon INT NOT NULL, idUser INT NOT NULL, INDEX idUser (idUser), INDEX abonnement_ibfk_2 (typeAbon), PRIMARY KEY(idAbonement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE activites (code INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, date_deb DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, id_user INT NOT NULL, salle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, titre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, idCategorie INT NOT NULL, INDEX id_user (id_user), INDEX idCategorie (idCategorie), PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (IdCategorie INT AUTO_INCREMENT NOT NULL, NomCategorie VARCHAR(255) CHARACTER SET armscii8 NOT NULL COLLATE `armscii8_general_ci`, DescriptionCategorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(IdCategorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorieactivite (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_magasin (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idUser INT NOT NULL, INDEX idUser (idUser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipement (IdEquipement INT AUTO_INCREMENT NOT NULL, NomEquipement VARCHAR(255) CHARACTER SET armscii8 NOT NULL COLLATE `armscii8_general_ci`, Quantite INT NOT NULL, DateAchat DATE NOT NULL, PrixAchat DOUBLE PRECISION NOT NULL, IdCategorie INT DEFAULT NULL, idUser INT NOT NULL, INDEX idUser (idUser), INDEX forgin key (IdCategorie), PRIMARY KEY(IdEquipement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE events (idtype INT NOT NULL, idEvent INT AUTO_INCREMENT NOT NULL, titreEvent VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nomCoach VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, typeEvent VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adresseEvent VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prixEvent DOUBLE PRECISION NOT NULL, dateEvent DATE NOT NULL, imgEvent VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nombrePlacesReservees INT NOT NULL, nombrePlacesTotal INT NOT NULL, idUser INT NOT NULL, INDEX idtype (idtype), INDEX idUser (idUser), PRIMARY KEY(idEvent)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE offer (idOffer INT AUTO_INCREMENT NOT NULL, titleOffer VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, descriptionOffer VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prix DOUBLE PRECISION NOT NULL, dateDebOffer DATE NOT NULL, dateFinOffer DATE NOT NULL, img VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idOffer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participation (idPart INT AUTO_INCREMENT NOT NULL, idEvent INT NOT NULL, Nom VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Prenom VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Ntel VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, DatePart DATE NOT NULL, idUser INT NOT NULL, INDEX participation_ibfk_1 (idEvent), INDEX idUser (idUser), PRIMARY KEY(idPart)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit (id_prd INT AUTO_INCREMENT NOT NULL, idAdmin INT DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, description VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, categorie VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idCategorie INT NOT NULL, INDEX idCategorie (idCategorie), PRIMARY KEY(id_prd)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit_commande (id INT AUTO_INCREMENT NOT NULL, id_prd INT NOT NULL, id_cmd INT NOT NULL, INDEX id_cmd (id_cmd), INDEX id_prd (id_prd), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (Id INT AUTO_INCREMENT NOT NULL, Description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, IdUser INT NOT NULL, INDEX IdUser (IdUser), PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_cours (id INT AUTO_INCREMENT NOT NULL, code INT DEFAULT NULL, date_res DATETIME DEFAULT NULL, id_user INT NOT NULL, INDEX reservation_cours_ibfk_2 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_offer (idReservation INT AUTO_INCREMENT NOT NULL, dateReservation DATE NOT NULL, idUser INT NOT NULL, idOffer INT NOT NULL, codePromo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX idOffer (idOffer), INDEX idUser (idUser), PRIMARY KEY(idReservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_abonn (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_event (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT forgin key FOREIGN KEY (IdCategorie) REFERENCES categorie (IdCategorie)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT equipement_ibfk_1 FOREIGN KEY (idUser) REFERENCES user (Id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT events_ibfk_1 FOREIGN KEY (idUser) REFERENCES user (Id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT events_ibfk_2 FOREIGN KEY (idtype) REFERENCES type_event (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT participation_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT participation_ibfk_1 FOREIGN KEY (idEvent) REFERENCES events (idEvent) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_ibfk_1 FOREIGN KEY (idCategorie) REFERENCES categorie_magasin (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (IdUser) REFERENCES user (Id)');
        $this->addSql('ALTER TABLE reservation_cours ADD CONSTRAINT reservation_cours_ibfk_2 FOREIGN KEY (code) REFERENCES activites (code)');
        $this->addSql('ALTER TABLE reservation_offer ADD CONSTRAINT reservation_offer_ibfk_1 FOREIGN KEY (idOffer) REFERENCES offer (idOffer) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_offer ADD CONSTRAINT reservation_offer_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C29773213');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CFE6E88D7');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C29773213');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CFE6E88D7');
        $this->addSql('ALTER TABLE comment CHANGE content content VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT comment_ibfk_1 FOREIGN KEY (idPost) REFERENCES post (idPost) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT comment_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id)');
        $this->addSql('DROP INDEX idx_9474526c29773213 ON comment');
        $this->addSql('CREATE INDEX idPost ON comment (idPost)');
        $this->addSql('DROP INDEX idx_9474526cfe6e88d7 ON comment');
        $this->addSql('CREATE INDEX idUser ON comment (idUser)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C29773213 FOREIGN KEY (idPost) REFERENCES post (idPost) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY FK_2DF3BE1129773213');
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY FK_2DF3BE11FE6E88D7');
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY FK_2DF3BE1129773213');
        $this->addSql('ALTER TABLE dislikes DROP FOREIGN KEY FK_2DF3BE11FE6E88D7');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT dislikes_ibfk_1 FOREIGN KEY (idPost) REFERENCES post (idPost) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT dislikes_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_2df3be1129773213 ON dislikes');
        $this->addSql('CREATE INDEX idPost ON dislikes (idPost)');
        $this->addSql('DROP INDEX idx_2df3be11fe6e88d7 ON dislikes');
        $this->addSql('CREATE INDEX idUser ON dislikes (idUser)');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT FK_2DF3BE1129773213 FOREIGN KEY (idPost) REFERENCES post (idPost) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislikes ADD CONSTRAINT FK_2DF3BE11FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D29773213');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DFE6E88D7');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D29773213');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DFE6E88D7');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT likes_ibfk_1 FOREIGN KEY (idPost) REFERENCES post (idPost) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT likes_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_49ca4e7d29773213 ON likes');
        $this->addSql('CREATE INDEX idPost ON likes (idPost)');
        $this->addSql('DROP INDEX idx_49ca4e7dfe6e88d7 ON likes');
        $this->addSql('CREATE INDEX idUser ON likes (idUser)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D29773213 FOREIGN KEY (idPost) REFERENCES post (idPost) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DFE6E88D7');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DFE6E88D7');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT post_ibfk_1 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_5a8a6c8dfe6e88d7 ON post');
        $this->addSql('CREATE INDEX id_User ON post (idUser)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
    }
}
