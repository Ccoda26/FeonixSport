<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201222190000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51C12469DE2 ON exercise (category_id)');
        $this->addSql('ALTER TABLE program ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_92ED778412469DE2 ON program (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C12469DE2');
        $this->addSql('DROP INDEX IDX_AEDAD51C12469DE2 ON exercise');
        $this->addSql('ALTER TABLE exercise DROP category_id');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778412469DE2');
        $this->addSql('DROP INDEX IDX_92ED778412469DE2 ON program');
        $this->addSql('ALTER TABLE program DROP category_id');
    }
}
