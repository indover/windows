<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704202308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, year_of_build INT DEFAULT NULL, deposit DOUBLE PRECISION DEFAULT NULL, balance DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE window_order ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE window_order ADD CONSTRAINT FK_20E860D79395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_20E860D79395C3F3 ON window_order (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE window_order DROP FOREIGN KEY FK_20E860D79395C3F3');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP INDEX IDX_20E860D79395C3F3 ON window_order');
        $this->addSql('ALTER TABLE window_order DROP customer_id');
    }
}
