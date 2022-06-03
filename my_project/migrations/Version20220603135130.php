<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603135130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player ADD team_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_98197A65B842D717 ON player (team_id_id)');
        $this->addSql('ALTER TABLE team ADD competition_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F8CF3AC81 FOREIGN KEY (competition_id_id) REFERENCES competition (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F8CF3AC81 ON team (competition_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65B842D717');
        $this->addSql('DROP INDEX IDX_98197A65B842D717 ON player');
        $this->addSql('ALTER TABLE player DROP team_id_id');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F8CF3AC81');
        $this->addSql('DROP INDEX IDX_C4E0A61F8CF3AC81 ON team');
        $this->addSql('ALTER TABLE team DROP competition_id_id');
    }
}
