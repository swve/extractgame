<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181107142045 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partie CHANGE terrain terrain LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE pioche pioche LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE main_j1 main_j1 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE main_j2 main_j2 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE chameaux_j1 chameaux_j1 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE chameaux_j2 chameaux_j2 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE jetons_j1 jetons_j1 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE jetons_j2 jetons_j2 LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE jetons_terrain jetons_terrain LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partie CHANGE terrain terrain LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE pioche pioche LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE main_j1 main_j1 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE main_j2 main_j2 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE chameaux_j1 chameaux_j1 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE chameaux_j2 chameaux_j2 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE jetons_j1 jetons_j1 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE jetons_j2 jetons_j2 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE jetons_terrain jetons_terrain LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
