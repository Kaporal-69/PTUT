<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505100301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit_producteur');
        $this->addSql('ALTER TABLE client ADD code_postal INT DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE producteur ADD code_postal INT DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, ADD nom_etablissement VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD producteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27AB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27AB9BB300 ON produit (producteur_id)');
        $this->addSql('ALTER TABLE restaurateur ADD code_postal INT DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, ADD nom_etablissement VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_producteur (produit_id INT NOT NULL, producteur_id INT NOT NULL, INDEX IDX_D7E3D71DF347EFB (produit_id), INDEX IDX_D7E3D71DAB9BB300 (producteur_id), PRIMARY KEY(produit_id, producteur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE produit_producteur ADD CONSTRAINT FK_D7E3D71DAB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_producteur ADD CONSTRAINT FK_D7E3D71DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client DROP code_postal, DROP ville');
        $this->addSql('ALTER TABLE producteur DROP code_postal, DROP ville, DROP nom_etablissement');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27AB9BB300');
        $this->addSql('DROP INDEX IDX_29A5EC27AB9BB300 ON produit');
        $this->addSql('ALTER TABLE produit DROP producteur_id');
        $this->addSql('ALTER TABLE restaurateur DROP code_postal, DROP ville, DROP nom_etablissement');
    }
}
