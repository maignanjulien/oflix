<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230921120407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE casting (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, role VARCHAR(100) NOT NULL, credit_order SMALLINT NOT NULL, INDEX IDX_D11BBA50217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting_movie (casting_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_CACC89289EB2648F (casting_id), INDEX IDX_CACC89288F93B6FC (movie_id), PRIMARY KEY(casting_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA50217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE casting_movie ADD CONSTRAINT FK_CACC89289EB2648F FOREIGN KEY (casting_id) REFERENCES casting (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE casting_movie ADD CONSTRAINT FK_CACC89288F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person CHANGE lastname lastname VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA50217BBB47');
        $this->addSql('ALTER TABLE casting_movie DROP FOREIGN KEY FK_CACC89289EB2648F');
        $this->addSql('ALTER TABLE casting_movie DROP FOREIGN KEY FK_CACC89288F93B6FC');
        $this->addSql('DROP TABLE casting');
        $this->addSql('DROP TABLE casting_movie');
        $this->addSql('ALTER TABLE person CHANGE lastname lastname VARCHAR(100) NOT NULL');
    }
}
