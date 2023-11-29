<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129175933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE clothes (id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, price INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, color VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, brand VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE clothes_size (clothes_id INT NOT NULL, size_id INT NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0FB7336F0 (queue_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE shoes (id INT AUTO_INCREMENT NOT NULL, brands_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, brand VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, color VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_14CF8197E9EEC0C7 (brands_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE shoes_size (shoes_id INT NOT NULL, size_id INT NOT NULL, INDEX IDX_287B7807B75E1D7A (shoes_id), INDEX IDX_287B7807498DA827 (size_id), PRIMARY KEY(shoes_id, size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE size_clothes (size_id INT NOT NULL, clothes_id INT NOT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('CREATE TABLE size_shoes (size_id INT NOT NULL, shoes_id INT NOT NULL, INDEX IDX_C51F43A0498DA827 (size_id), INDEX IDX_C51F43A0B75E1D7A (shoes_id), PRIMARY KEY(size_id, shoes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE brand');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE clothes');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE clothes_size');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE messenger_messages');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE shoes');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE shoes_size');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE size');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE size_clothes');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1052Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1052Platform'."
        );

        $this->addSql('DROP TABLE size_shoes');
    }
}
