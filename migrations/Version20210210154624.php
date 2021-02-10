<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210154624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_choice_date (booking_id INT NOT NULL, choice_date_id INT NOT NULL, INDEX IDX_D89A53903301C60 (booking_id), INDEX IDX_D89A53908171F225 (choice_date_id), PRIMARY KEY(booking_id, choice_date_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_choice_date ADD CONSTRAINT FK_D89A53903301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_choice_date ADD CONSTRAINT FK_D89A53908171F225 FOREIGN KEY (choice_date_id) REFERENCES choice_date (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE choice_date DROP FOREIGN KEY FK_FF0188593301C60');
        $this->addSql('DROP INDEX IDX_FF0188593301C60 ON choice_date');
        $this->addSql('ALTER TABLE choice_date DROP booking_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE booking_choice_date');
        $this->addSql('ALTER TABLE choice_date ADD booking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choice_date ADD CONSTRAINT FK_FF0188593301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('CREATE INDEX IDX_FF0188593301C60 ON choice_date (booking_id)');
    }
}
