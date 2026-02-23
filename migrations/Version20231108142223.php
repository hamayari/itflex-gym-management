<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108142223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY abonnement_ibfk_1');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY abonnement_ibfk_2');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY activites_ibfk_1');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY activites_ibfk_2');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_1');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_2');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY forgin key');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY equipement_ibfk_1');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY post_ibfk_1');
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
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reservation_cours');
        $this->addSql('DROP TABLE reservation_offer');
        $this->addSql('DROP TABLE type_abonn');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY events_ibfk_1');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY events_ibfk_2');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY events_ibfk_1');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY events_ibfk_2');
        $this->addSql('ALTER TABLE events CHANGE dateEvent dateevent DATETIME NOT NULL');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A5F11A689 FOREIGN KEY (idtype) REFERENCES type_event (Id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX iduser ON events');
        $this->addSql('CREATE INDEX IDX_5387574AFE6E88D7 ON events (idUser)');
        $this->addSql('DROP INDEX idtype ON events');
        $this->addSql('CREATE INDEX IDX_5387574A5F11A689 ON events (idtype)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT events_ibfk_1 FOREIGN KEY (idUser) REFERENCES user (Id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT events_ibfk_2 FOREIGN KEY (idtype) REFERENCES type_event (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY participation_ibfk_1');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY participation_ibfk_2');
        $this->addSql('DROP INDEX participation_ibfk_1 ON participation');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY participation_ibfk_2');
        $this->addSql('ALTER TABLE participation DROP idEvent, CHANGE DatePart datepart DATETIME NOT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX iduser ON participation');
        $this->addSql('CREATE INDEX IDX_AB55E24FFE6E88D7 ON participation (idUser)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT participation_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // Add SQL statements to reverse the changes made in the up() method
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AFE6E88D7');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A5F11A689');
        $this->addSql('ALTER TABLE events CHANGE dateevent dateEvent DATE NOT NULL');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A5F11A689 FOREIGN KEY (idtype) REFERENCES type_event (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_5387574afe6e88d7 ON events');
        $this->addSql('CREATE INDEX idUser ON events (idUser)');
        $this->addSql('DROP INDEX idx_5387574a5f11a689 ON events');
        $this->addSql('CREATE INDEX idtype ON events (idtype)');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FFE6E88D7');
        $this->addSql('ALTER TABLE participation ADD idEvent INT NOT NULL, CHANGE datepart DatePart DATE NOT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT participation_ibfk_1 FOREIGN KEY (idEvent) REFERENCES events (idEvent) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT participation_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (Id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX participation_ibfk_1 ON participation (idEvent)');
        $this->addSql('DROP INDEX idx_ab55e24ffe6e88d7 ON participation');
        $this->addSql('CREATE INDEX idUser ON participation (idUser)');
    }
    }
