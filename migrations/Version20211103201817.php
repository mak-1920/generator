<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103201817 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE RuNames_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE RuPatronymic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE RuSurnames_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE RuNames (id INT NOT NULL, name VARCHAR(25) NOT NULL, gender VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE RuPatronymic (id INT NOT NULL, patronymic VARCHAR(25) NOT NULL, gender VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE RuSurnames (id INT NOT NULL, surname VARCHAR(25) NOT NULL, gender VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE RuNames_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE RuPatronymic_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE RuSurnames_id_seq CASCADE');
        $this->addSql('CREATE TABLE runames (id INT NOT NULL, name VARCHAR(25) NOT NULL, gender VARCHAR(10) NOT NULL)');
        $this->addSql('CREATE TABLE rusurnames (id INT NOT NULL, surname VARCHAR(25) NOT NULL, gender VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rupatronymics (id INT NOT NULL, patronymic VARCHAR(25) NOT NULL, gender VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
    }
}
