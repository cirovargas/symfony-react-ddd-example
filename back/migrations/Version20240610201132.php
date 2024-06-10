<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610201132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE charge ADD charge_batch_file_id INT NOT NULL');
        $this->addSql('ALTER TABLE charge ADD CONSTRAINT FK_556BA4345DB3C5A3 FOREIGN KEY (charge_batch_file_id) REFERENCES charge_batch_file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_556BA4345DB3C5A3 ON charge (charge_batch_file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE charge DROP CONSTRAINT FK_556BA4345DB3C5A3');
        $this->addSql('DROP INDEX IDX_556BA4345DB3C5A3');
        $this->addSql('ALTER TABLE charge DROP charge_batch_file_id');
    }
}
