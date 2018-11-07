<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181107174835 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partie ADD joueur1_id INT DEFAULT NULL, ADD joueur2_id INT DEFAULT NULL, DROP joueur1, DROP joueur2');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D92C1E237 FOREIGN KEY (joueur1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D80744DD9 FOREIGN KEY (joueur2_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_59B1F3D92C1E237 ON partie (joueur1_id)');
        $this->addSql('CREATE INDEX IDX_59B1F3D80744DD9 ON partie (joueur2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D92C1E237');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D80744DD9');
        $this->addSql('DROP INDEX IDX_59B1F3D92C1E237 ON partie');
        $this->addSql('DROP INDEX IDX_59B1F3D80744DD9 ON partie');
        $this->addSql('ALTER TABLE partie ADD joueur1 INT NOT NULL, ADD joueur2 INT NOT NULL, DROP joueur1_id, DROP joueur2_id');
    }
}
