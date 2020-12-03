<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202143715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise_media (exercise_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_4F1A56CEE934951A (exercise_id), INDEX IDX_4F1A56CEEA9FDD75 (media_id), PRIMARY KEY(exercise_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_media (program_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_F445D2FA3EB8070A (program_id), INDEX IDX_F445D2FAEA9FDD75 (media_id), PRIMARY KEY(program_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise_media ADD CONSTRAINT FK_4F1A56CEE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_media ADD CONSTRAINT FK_4F1A56CEEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_media ADD CONSTRAINT FK_F445D2FA3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_media ADD CONSTRAINT FK_F445D2FAEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE exercise_media');
        $this->addSql('DROP TABLE program_media');
    }
}
