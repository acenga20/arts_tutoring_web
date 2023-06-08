<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515202536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lecture_user DROP FOREIGN KEY FK_317B616635E32FCD');
        $this->addSql('ALTER TABLE lecture_user DROP FOREIGN KEY FK_317B6166A76ED395');
        $this->addSql('DROP TABLE lecture_user');
        $this->addSql('ALTER TABLE lecture ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C1677948A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C1677948A76ED395 ON lecture (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lecture_user (lecture_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_317B616635E32FCD (lecture_id), INDEX IDX_317B6166A76ED395 (user_id), PRIMARY KEY(lecture_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lecture_user ADD CONSTRAINT FK_317B616635E32FCD FOREIGN KEY (lecture_id) REFERENCES lecture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecture_user ADD CONSTRAINT FK_317B6166A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C1677948A76ED395');
        $this->addSql('DROP INDEX IDX_C1677948A76ED395 ON lecture');
        $this->addSql('ALTER TABLE lecture DROP user_id');
    }
}
