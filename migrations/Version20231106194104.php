<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106194104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement ADD IdCategorie INT NOT NULL');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3330B72B5 FOREIGN KEY (IdCategorie) REFERENCES categorie (IdCategorie)');
        $this->addSql('CREATE INDEX IDX_B8B4C6F3330B72B5 ON equipement (IdCategorie)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3330B72B5');
        $this->addSql('DROP INDEX IDX_B8B4C6F3330B72B5 ON equipement');
        $this->addSql('ALTER TABLE equipement DROP IdCategorie');
    }
}
