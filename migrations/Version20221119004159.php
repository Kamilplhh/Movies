<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119004159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movieactor (id INT AUTO_INCREMENT NOT NULL, actor_id_id INT DEFAULT NULL, movie_id_id INT DEFAULT NULL, INDEX IDX_EA3607EF5BC075C3 (actor_id_id), INDEX IDX_EA3607EF10684CB (movie_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movieactor ADD CONSTRAINT FK_EA3607EF5BC075C3 FOREIGN KEY (actor_id_id) REFERENCES actor (id)');
        $this->addSql('ALTER TABLE movieactor ADD CONSTRAINT FK_EA3607EF10684CB FOREIGN KEY (movie_id_id) REFERENCES movie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movieactor DROP FOREIGN KEY FK_EA3607EF5BC075C3');
        $this->addSql('ALTER TABLE movieactor DROP FOREIGN KEY FK_EA3607EF10684CB');
        $this->addSql('DROP TABLE movieactor');
    }
}
