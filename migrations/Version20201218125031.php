<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218125031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE level level VARCHAR(255) DEFAULT NULL, CHANGE date date DATE DEFAULT NULL, CHANGE starthour starthour TIME DEFAULT NULL, CHANGE end_hour end_hour TIME DEFAULT NULL, CHANGE price price DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE level level VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date date DATE NOT NULL, CHANGE starthour starthour TIME NOT NULL, CHANGE end_hour end_hour TIME NOT NULL, CHANGE price price DOUBLE PRECISION NOT NULL');
    }
}
