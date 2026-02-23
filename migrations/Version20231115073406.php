<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115073406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY FK_766B5EB5FE6E88D7');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY FK_766B5EB537667FC1');
        $this->addSql('DROP INDEX idcategorie ON activites');
        $this->addSql('CREATE INDEX IDX_766B5EB537667FC1 ON activites (idcategorie)');
        $this->addSql('DROP INDEX id_user ON activites');
        $this->addSql('CREATE INDEX IDX_766B5EB5FE6E88D7 ON activites (idUser)');
        $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB5FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB537667FC1 FOREIGN KEY (idCategorie) REFERENCES categorieactivite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_cours DROP FOREIGN KEY reservation_cours_ibfk_2');
        $this->addSql('ALTER TABLE reservation_cours DROP FOREIGN KEY reservation_cours_ibfk_2');
        $this->addSql('ALTER TABLE reservation_cours CHANGE code code INT NOT NULL, CHANGE date_res date_res VARCHAR(255) NOT NULL, CHANGE idUser id_user INT NOT NULL');
        $this->addSql('ALTER TABLE reservation_cours ADD CONSTRAINT FK_BEB55C3B77153098 FOREIGN KEY (code) REFERENCES activites (code) ON DELETE CASCADE');
        $this->addSql('DROP INDEX reservation_cours_ibfk_2 ON reservation_cours');
        $this->addSql('CREATE INDEX IDX_BEB55C3B77153098 ON reservation_cours (code)');
        $this->addSql('ALTER TABLE reservation_cours ADD CONSTRAINT reservation_cours_ibfk_2 FOREIGN KEY (code) REFERENCES activites (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY FK_766B5EB537667FC1');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY FK_766B5EB5FE6E88D7');
        $this->addSql('DROP INDEX idx_766b5eb537667fc1 ON activites');
        $this->addSql('CREATE INDEX idCategorie ON activites (idCategorie)');
        $this->addSql('DROP INDEX idx_766b5eb5fe6e88d7 ON activites');
        $this->addSql('CREATE INDEX id_user ON activites (idUser)');
        $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB537667FC1 FOREIGN KEY (idcategorie) REFERENCES categorieactivite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB5FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (Id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_cours DROP FOREIGN KEY FK_BEB55C3B77153098');
        $this->addSql('ALTER TABLE reservation_cours DROP FOREIGN KEY FK_BEB55C3B77153098');
        $this->addSql('ALTER TABLE reservation_cours CHANGE code code INT DEFAULT NULL, CHANGE date_res date_res DATETIME DEFAULT NULL, CHANGE id_user idUser INT NOT NULL');
        $this->addSql('ALTER TABLE reservation_cours ADD CONSTRAINT reservation_cours_ibfk_2 FOREIGN KEY (code) REFERENCES activites (code)');
        $this->addSql('DROP INDEX idx_beb55c3b77153098 ON reservation_cours');
        $this->addSql('CREATE INDEX reservation_cours_ibfk_2 ON reservation_cours (code)');
        $this->addSql('ALTER TABLE reservation_cours ADD CONSTRAINT FK_BEB55C3B77153098 FOREIGN KEY (code) REFERENCES activites (code) ON DELETE CASCADE');
    }
}
