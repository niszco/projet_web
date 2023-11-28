<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128162533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shoes (id INT AUTO_INCREMENT NOT NULL, brands_id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(40) NOT NULL, price INT NOT NULL, description VARCHAR(255) NOT NULL, color VARCHAR(30) DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_14CF8197E9EEC0C7 (brands_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shoes_size (shoes_id INT NOT NULL, size_id INT NOT NULL, INDEX IDX_287B7807B75E1D7A (shoes_id), INDEX IDX_287B7807498DA827 (size_id), PRIMARY KEY(shoes_id, size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size_shoes (size_id INT NOT NULL, shoes_id INT NOT NULL, INDEX IDX_C51F43A0498DA827 (size_id), INDEX IDX_C51F43A0B75E1D7A (shoes_id), PRIMARY KEY(size_id, shoes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shoes ADD CONSTRAINT FK_14CF8197E9EEC0C7 FOREIGN KEY (brands_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE shoes_size ADD CONSTRAINT FK_287B7807B75E1D7A FOREIGN KEY (shoes_id) REFERENCES shoes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shoes_size ADD CONSTRAINT FK_287B7807498DA827 FOREIGN KEY (size_id) REFERENCES size (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE size_shoes ADD CONSTRAINT FK_C51F43A0498DA827 FOREIGN KEY (size_id) REFERENCES size (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE size_shoes ADD CONSTRAINT FK_C51F43A0B75E1D7A FOREIGN KEY (shoes_id) REFERENCES shoes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoes DROP FOREIGN KEY FK_14CF8197E9EEC0C7');
        $this->addSql('ALTER TABLE shoes_size DROP FOREIGN KEY FK_287B7807B75E1D7A');
        $this->addSql('ALTER TABLE shoes_size DROP FOREIGN KEY FK_287B7807498DA827');
        $this->addSql('ALTER TABLE size_shoes DROP FOREIGN KEY FK_C51F43A0498DA827');
        $this->addSql('ALTER TABLE size_shoes DROP FOREIGN KEY FK_C51F43A0B75E1D7A');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE shoes');
        $this->addSql('DROP TABLE shoes_size');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE size_shoes');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
