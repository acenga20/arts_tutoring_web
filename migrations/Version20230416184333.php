<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230416184333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, field VARCHAR(255) NOT NULL, image LONGBLOB NOT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION DEFAULT NULL, quantity INT DEFAULT NULL, image LONGBLOB NOT NULL, item_condition VARCHAR(255) DEFAULT NULL, INDEX IDX_1F1B251EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecture (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, start_date DATETIME DEFAULT NULL, image LONGBLOB DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, field VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecture_user (lecture_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_317B616635E32FCD (lecture_id), INDEX IDX_317B6166A76ED395 (user_id), PRIMARY KEY(lecture_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating_user (rating_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_49EB45CCA32EFC6 (rating_id), INDEX IDX_49EB45CCA76ED395 (user_id), PRIMARY KEY(rating_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating_lecture (rating_id INT NOT NULL, lecture_id INT NOT NULL, INDEX IDX_222B8030A32EFC6 (rating_id), INDEX IDX_222B803035E32FCD (lecture_id), PRIMARY KEY(rating_id, lecture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, interests VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, type VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lecture_user ADD CONSTRAINT FK_317B616635E32FCD FOREIGN KEY (lecture_id) REFERENCES lecture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecture_user ADD CONSTRAINT FK_317B6166A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating_user ADD CONSTRAINT FK_49EB45CCA32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating_user ADD CONSTRAINT FK_49EB45CCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating_lecture ADD CONSTRAINT FK_222B8030A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating_lecture ADD CONSTRAINT FK_222B803035E32FCD FOREIGN KEY (lecture_id) REFERENCES lecture (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EA76ED395');
        $this->addSql('ALTER TABLE lecture_user DROP FOREIGN KEY FK_317B616635E32FCD');
        $this->addSql('ALTER TABLE lecture_user DROP FOREIGN KEY FK_317B6166A76ED395');
        $this->addSql('ALTER TABLE rating_user DROP FOREIGN KEY FK_49EB45CCA32EFC6');
        $this->addSql('ALTER TABLE rating_user DROP FOREIGN KEY FK_49EB45CCA76ED395');
        $this->addSql('ALTER TABLE rating_lecture DROP FOREIGN KEY FK_222B8030A32EFC6');
        $this->addSql('ALTER TABLE rating_lecture DROP FOREIGN KEY FK_222B803035E32FCD');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE lecture');
        $this->addSql('DROP TABLE lecture_user');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE rating_user');
        $this->addSql('DROP TABLE rating_lecture');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
