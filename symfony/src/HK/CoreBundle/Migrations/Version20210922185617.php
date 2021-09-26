<?php

declare(strict_types=1);

namespace HK\CoreBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210922185617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hkcustomer_product_warranties (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, content_status VARCHAR(255) DEFAULT NULL, warranty_date DATETIME DEFAULT NULL, display_order INT NOT NULL, view_counter INT DEFAULT NULL, is_deleted TINYINT(1) NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_published TINYINT(1) NOT NULL, published_from_at DATETIME DEFAULT NULL, published_to_at DATETIME DEFAULT NULL, photo_url VARCHAR(255) DEFAULT NULL, INDEX IDX_59500C79395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hkcustomer_product_warranties ADD CONSTRAINT FK_59500C79395C3F3 FOREIGN KEY (customer_id) REFERENCES hkcustomers (id)');
        $this->addSql('ALTER TABLE hkcustomers ADD product_serial VARCHAR(20) NOT NULL, ADD gif_serial VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE hkcustomer_product_warranties');
        $this->addSql('ALTER TABLE hkcustomers DROP product_serial, DROP gif_serial');
    }
}
