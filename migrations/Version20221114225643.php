<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114225643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor ADD rating_id INT DEFAULT NULL, ADD rating INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actor ADD CONSTRAINT FK_447556F9A32EFC6 FOREIGN KEY (rating_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_447556F9A32EFC6 ON actor (rating_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor DROP FOREIGN KEY FK_447556F9A32EFC6');
        $this->addSql('DROP INDEX IDX_447556F9A32EFC6 ON actor');
        $this->addSql('ALTER TABLE actor DROP rating_id, DROP rating');
    }
}
