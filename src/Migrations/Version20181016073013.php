<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181016073013 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, fichier VARCHAR(255) NOT NULL, valeur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeton (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, valeur INT NOT NULL, fichier VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, joueur1_id INT DEFAULT NULL, joueur2_id INT DEFAULT NULL, date DATETIME NOT NULL, status VARCHAR(1) NOT NULL, terrain LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', pioche LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', jeton_chameaux INT NOT NULL, defausse TINYINT(1) NOT NULL, main_j1 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', main_j2 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', chameaux_j1 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', chameaux_j2 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', jetons_j1 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', jetons_j2 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', nb_manche INT NOT NULL, point_j1 INT NOT NULL, point_j2 INT NOT NULL, jetons_terrain LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_59B1F3D92C1E237 (joueur1_id), INDEX IDX_59B1F3D80744DD9 (joueur2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D92C1E237 FOREIGN KEY (joueur1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D80744DD9 FOREIGN KEY (joueur2_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE carte');
        $this->addSql('DROP TABLE jeton');
        $this->addSql('DROP TABLE partie');
    }
}
