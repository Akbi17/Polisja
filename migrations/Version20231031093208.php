<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031093208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, maker VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year INT NOT NULL, coverage_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE auto');
        $this->addSql('ALTER TABLE business ADD policy_start_date DATE NOT NULL, ADD policy_end_date DATE NOT NULL, DROP policystartdate, DROP policyenddate, CHANGE name_of_business company_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE health CHANGE dateofbirth birth_date DATE NOT NULL');
        $this->addSql('ALTER TABLE property ADD house_type VARCHAR(255) NOT NULL, ADD construction_type VARCHAR(255) NOT NULL, DROP type_of_house, DROP constructiontype, CHANGE yearbuilt year_built INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auto (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, carmake VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, carmodel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, caryear INT NOT NULL, coveragetype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE car');
        $this->addSql('ALTER TABLE health CHANGE birth_date dateofbirth DATE NOT NULL');
        $this->addSql('ALTER TABLE property ADD type_of_house VARCHAR(255) NOT NULL, ADD constructiontype VARCHAR(255) NOT NULL, DROP house_type, DROP construction_type, CHANGE year_built yearbuilt INT NOT NULL');
        $this->addSql('ALTER TABLE business ADD policystartdate DATE NOT NULL, ADD policyenddate DATE NOT NULL, DROP policy_start_date, DROP policy_end_date, CHANGE company_name name_of_business VARCHAR(255) NOT NULL');
    }
}
