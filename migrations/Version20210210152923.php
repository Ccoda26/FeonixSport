<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210152923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choice_date DROP FOREIGN KEY FK_FF0188593256915B');
        $this->addSql('DROP INDEX UNIQ_FF0188593256915B ON choice_date');
        $this->addSql('ALTER TABLE choice_date ADD booking_id INT DEFAULT NULL, DROP relation_id');
        $this->addSql('ALTER TABLE choice_date ADD CONSTRAINT FK_FF0188593301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('CREATE INDEX IDX_FF0188593301C60 ON choice_date (booking_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choice_date DROP FOREIGN KEY FK_FF0188593301C60');
        $this->addSql('DROP INDEX IDX_FF0188593301C60 ON choice_date');
        $this->addSql('ALTER TABLE choice_date ADD relation_id INT NOT NULL, DROP booking_id');
        $this->addSql('ALTER TABLE choice_date ADD CONSTRAINT FK_FF0188593256915B FOREIGN KEY (relation_id) REFERENCES booking (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF0188593256915B ON choice_date (relation_id)');
    }
}
