<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230724101538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auto ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD carmake VARCHAR(255) NOT NULL, ADD carmodel VARCHAR(255) NOT NULL, ADD caryear INT NOT NULL, ADD coveragetype VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auto DROP firstname, DROP lastname, DROP email, DROP phone, DROP carmake, DROP carmodel, DROP caryear, DROP coveragetype');
    }
}
