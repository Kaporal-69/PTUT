<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224141748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_plat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, restaurateur_emetteur_id INT DEFAULT NULL, restaurateur_destinataire_id INT DEFAULT NULL, producteur_id INT DEFAULT NULL, prix_total DOUBLE PRECISION NOT NULL, etat_commande INT NOT NULL, type_commande SMALLINT NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67DF22C514 (restaurateur_emetteur_id), INDEX IDX_6EEAA67DE8D363E8 (restaurateur_destinataire_id), INDEX IDX_6EEAA67DAB9BB300 (producteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, plat_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, prix_total DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, INDEX IDX_3170B74BF347EFB (produit_id), INDEX IDX_3170B74BD73DB560 (plat_id), INDEX IDX_3170B74B82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, restaurateur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2038A2073B311E56 (restaurateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producteur (id INT AUTO_INCREMENT NOT NULL, site VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_produit_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_29A5EC2791FDB457 (categorie_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_producteur (produit_id INT NOT NULL, producteur_id INT NOT NULL, INDEX IDX_D7E3D71DF347EFB (produit_id), INDEX IDX_D7E3D71DAB9BB300 (producteur_id), PRIMARY KEY(produit_id, producteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurateur (id INT AUTO_INCREMENT NOT NULL, site VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, retaurateur_id INT DEFAULT NULL, client_id INT DEFAULT NULL, producteur_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649841EE0E0 (retaurateur_id), UNIQUE INDEX UNIQ_8D93D64919EB6921 (client_id), UNIQUE INDEX UNIQ_8D93D649AB9BB300 (producteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF22C514 FOREIGN KEY (restaurateur_emetteur_id) REFERENCES restaurateur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DE8D363E8 FOREIGN KEY (restaurateur_destinataire_id) REFERENCES restaurateur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DAB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BD73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A2073B311E56 FOREIGN KEY (restaurateur_id) REFERENCES restaurateur (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2791FDB457 FOREIGN KEY (categorie_produit_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE produit_producteur ADD CONSTRAINT FK_D7E3D71DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_producteur ADD CONSTRAINT FK_D7E3D71DAB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649841EE0E0 FOREIGN KEY (retaurateur_id) REFERENCES restaurateur (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2791FDB457');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64919EB6921');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BD73DB560');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAB9BB300');
        $this->addSql('ALTER TABLE produit_producteur DROP FOREIGN KEY FK_D7E3D71DAB9BB300');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AB9BB300');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BF347EFB');
        $this->addSql('ALTER TABLE produit_producteur DROP FOREIGN KEY FK_D7E3D71DF347EFB');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF22C514');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DE8D363E8');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A2073B311E56');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649841EE0E0');
        $this->addSql('DROP TABLE categorie_plat');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE plat');
        $this->addSql('DROP TABLE producteur');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_producteur');
        $this->addSql('DROP TABLE restaurateur');
        $this->addSql('DROP TABLE user');
    }
}
