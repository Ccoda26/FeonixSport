<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208083609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture_article (picture_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_1F1CFAB4EE45BDBF (picture_id), INDEX IDX_1F1CFAB47294869C (article_id), PRIMARY KEY(picture_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture_article ADD CONSTRAINT FK_1F1CFAB4EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_article ADD CONSTRAINT FK_1F1CFAB47294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F897294869C');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89E934951A');
        $this->addSql('DROP INDEX IDX_16DB4F89E934951A ON picture');
        $this->addSql('DROP INDEX IDX_16DB4F897294869C ON picture');
        $this->addSql('ALTER TABLE picture DROP article_id, DROP exercise_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE picture_article');
        $this->addSql('ALTER TABLE picture ADD article_id INT DEFAULT NULL, ADD exercise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F897294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89E934951A ON picture (exercise_id)');
        $this->addSql('CREATE INDEX IDX_16DB4F897294869C ON picture (article_id)');
    }
}
