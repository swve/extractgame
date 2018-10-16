<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181016064327 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, fichier VARCHAR(255) NOT NULL, valeur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeton (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, valeur INT NOT NULL, fichier VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, joueur1_id INT DEFAULT NULL, joueur2_id INT DEFAULT NULL, date DATETIME DEFAULT NULL, status VARCHAR(1) DEFAULT NULL, terrain JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', pioche JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', jeton_chameaux INT DEFAULT NULL, defausse TINYINT(1) DEFAULT NULL, main_j1 JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', main_j2 JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', chameaux_j1 JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', chameaux_j2 JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', jetons_j1 JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', jetons_j2 JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', nb_manche INT DEFAULT NULL, point_j1 INT DEFAULT NULL, point_j2 INT DEFAULT NULL, jetons_terrain JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_59B1F3D92C1E237 (joueur1_id), INDEX IDX_59B1F3D80744DD9 (joueur2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
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
