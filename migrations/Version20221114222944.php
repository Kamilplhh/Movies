<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114222944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor ADD rating_id INT DEFAULT NULL, ADD image_path VARCHAR(255) NOT NULL, DROP ImagePath, CHANGE rating rating INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actor ADD CONSTRAINT FK_447556F9A32EFC6 FOREIGN KEY (rating_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_447556F9A32EFC6 ON actor (rating_id)');
        $this->addSql('ALTER TABLE movie_actor ADD CONSTRAINT FK_3A374C6510DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor DROP FOREIGN KEY FK_447556F9A32EFC6');
        $this->addSql('DROP INDEX IDX_447556F9A32EFC6 ON actor');
        $this->addSql('ALTER TABLE actor ADD ImagePath VARCHAR(255) DEFAULT NULL, DROP rating_id, DROP image_path, CHANGE rating rating INT NOT NULL');
        $this->addSql('ALTER TABLE movie_actor DROP FOREIGN KEY FK_3A374C6510DAF24A');
    }
}
