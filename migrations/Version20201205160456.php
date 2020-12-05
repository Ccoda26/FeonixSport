<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201205160456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, file_name VARCHAR(255) DEFAULT NULL, INDEX IDX_16DB4F897294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F897294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('DROP TABLE article_media');
        $this->addSql('DROP TABLE exercise_media');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_media (article_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_1D9BD31D7294869C (article_id), INDEX IDX_1D9BD31DEA9FDD75 (media_id), PRIMARY KEY(article_id, media_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exercise_media (exercise_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_4F1A56CEE934951A (exercise_id), INDEX IDX_4F1A56CEEA9FDD75 (media_id), PRIMARY KEY(exercise_id, media_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article_media ADD CONSTRAINT FK_1D9BD31D7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_media ADD CONSTRAINT FK_1D9BD31DEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_media ADD CONSTRAINT FK_4F1A56CEE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_media ADD CONSTRAINT FK_4F1A56CEEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE picture');
    }
}
