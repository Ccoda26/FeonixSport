<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307153714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_picture (article_id INT NOT NULL, picture_id INT NOT NULL, INDEX IDX_FB090B3E7294869C (article_id), INDEX IDX_FB090B3EEE45BDBF (picture_id), PRIMARY KEY(article_id, picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, begin_at DATETIME NOT NULL, end_at DATETIME NOT NULL, INDEX IDX_E00CEDDE19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise_picture (exercise_id INT NOT NULL, picture_id INT NOT NULL, INDEX IDX_CCCEB8CCE934951A (exercise_id), INDEX IDX_CCCEB8CCEE45BDBF (picture_id), PRIMARY KEY(exercise_id, picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3E7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3EEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE exercise_picture ADD CONSTRAINT FK_CCCEB8CCE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise_picture ADD CONSTRAINT FK_CCCEB8CCEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercise ADD category_id INT DEFAULT NULL, CHANGE name_excercise name VARCHAR(255) NOT NULL, CHANGE exercise_descritpion description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51C12469DE2 ON exercise (category_id)');
        $this->addSql('ALTER TABLE program ADD filename_id INT DEFAULT NULL, ADD category_id INT DEFAULT NULL, DROP content');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778430335DEA FOREIGN KEY (filename_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92ED778430335DEA ON program (filename_id)');
        $this->addSql('CREATE INDEX IDX_92ED778412469DE2 ON program (category_id)');
        $this->addSql('ALTER TABLE user ADD phone_number VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C12469DE2');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778412469DE2');
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3EEE45BDBF');
        $this->addSql('ALTER TABLE exercise_picture DROP FOREIGN KEY FK_CCCEB8CCEE45BDBF');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778430335DEA');
        $this->addSql('DROP TABLE article_picture');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE exercise_picture');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP INDEX IDX_AEDAD51C12469DE2 ON exercise');
        $this->addSql('ALTER TABLE exercise DROP category_id, CHANGE name name_excercise VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description exercise_descritpion LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_92ED778430335DEA ON program');
        $this->addSql('DROP INDEX IDX_92ED778412469DE2 ON program');
        $this->addSql('ALTER TABLE program ADD content VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP filename_id, DROP category_id');
        $this->addSql('ALTER TABLE user DROP phone_number');
    }
}
