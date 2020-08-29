<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200829113901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create asteroid table with isHazardous and speed indexes';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE asteroid (
                              id INT AUTO_INCREMENT NOT NULL, 
                              name VARCHAR(255) NOT NULL, 
                              reference INT NOT NULL, 
                              speed DOUBLE PRECISION NOT NULL, 
                              date DATETIME NOT NULL, 
                              is_hazardous TINYINT(1) NOT NULL, 
                              INDEX isHazardous (is_hazardous), 
                              INDEX speed (speed), 
                              PRIMARY KEY(id)
                            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE asteroid');
    }
}
