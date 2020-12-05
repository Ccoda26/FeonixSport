<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201205160933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD exercise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89E934951A ON picture (exercise_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89E934951A');
        $this->addSql('DROP INDEX IDX_16DB4F89E934951A ON picture');
        $this->addSql('ALTER TABLE picture DROP exercise_id');
    }
}
