<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212221621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program ADD filename_id INT DEFAULT NULL, DROP filename');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778430335DEA FOREIGN KEY (filename_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92ED778430335DEA ON program (filename_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778430335DEA');
        $this->addSql('DROP INDEX UNIQ_92ED778430335DEA ON program');
        $this->addSql('ALTER TABLE program ADD filename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP filename_id');
    }
}
