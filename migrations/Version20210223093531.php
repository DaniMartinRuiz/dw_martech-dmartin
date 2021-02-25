<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223093531 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE productos ADD members_id INT NOT NULL');
        $this->addSql('ALTER TABLE productos ADD CONSTRAINT FK_767490E6BD01F5ED FOREIGN KEY (members_id) REFERENCES members (id)');
        $this->addSql('CREATE INDEX IDX_767490E6BD01F5ED ON productos (members_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE productos DROP FOREIGN KEY FK_767490E6BD01F5ED');
        $this->addSql('DROP INDEX IDX_767490E6BD01F5ED ON productos');
        $this->addSql('ALTER TABLE productos DROP members_id');
    }
}
