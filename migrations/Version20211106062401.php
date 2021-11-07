<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106062401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE UsNames_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE UsSurnames_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE UsNames (id INT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE UsSurnames (id INT NOT NULL, surname VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE ruaddrsubjects ALTER type SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE UsNames_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE UsSurnames_id_seq CASCADE');
        $this->addSql('DROP TABLE UsNames');
        $this->addSql('DROP TABLE UsSurnames');
        $this->addSql('ALTER TABLE RuAddrSubjects ALTER type DROP NOT NULL');
    }
}
