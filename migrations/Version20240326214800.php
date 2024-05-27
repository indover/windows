<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326214800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_status DROP FOREIGN KEY FK_B88F75C98D9F6D38');
        $this->addSql('DROP INDEX UNIQ_B88F75C98D9F6D38 ON order_status');
        $this->addSql('ALTER TABLE order_status DROP order_id');
        $this->addSql('ALTER TABLE window_order DROP INDEX UNIQ_20E860D76BF700BD, ADD INDEX IDX_20E860D76BF700BD (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_status ADD order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_status ADD CONSTRAINT FK_B88F75C98D9F6D38 FOREIGN KEY (order_id) REFERENCES window_order (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B88F75C98D9F6D38 ON order_status (order_id)');
        $this->addSql('ALTER TABLE window_order DROP INDEX IDX_20E860D76BF700BD, ADD UNIQUE INDEX UNIQ_20E860D76BF700BD (status_id)');
    }
}
