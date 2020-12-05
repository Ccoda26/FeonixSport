<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203140438 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE program_media');
        $this->addSql('ALTER TABLE media ADD program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C3EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A2CA10C3EB8070A ON media (program_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE program_media (program_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_F445D2FA3EB8070A (program_id), INDEX IDX_F445D2FAEA9FDD75 (media_id), PRIMARY KEY(program_id, media_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE program_media ADD CONSTRAINT FK_F445D2FA3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_media ADD CONSTRAINT FK_F445D2FAEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C3EB8070A');
        $this->addSql('DROP INDEX UNIQ_6A2CA10C3EB8070A ON media');
        $this->addSql('ALTER TABLE media DROP program_id');
    }
}
