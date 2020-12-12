<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212221519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778430335DEA');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784A76ED395');
        $this->addSql('DROP INDEX IDX_92ED7784A76ED395 ON program');
        $this->addSql('DROP INDEX UNIQ_92ED778430335DEA ON program');
        $this->addSql('ALTER TABLE program ADD filename VARCHAR(255) NOT NULL, DROP user_id, DROP filename_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program ADD user_id INT DEFAULT NULL, ADD filename_id INT DEFAULT NULL, DROP filename');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778430335DEA FOREIGN KEY (filename_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_92ED7784A76ED395 ON program (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92ED778430335DEA ON program (filename_id)');
    }
}
