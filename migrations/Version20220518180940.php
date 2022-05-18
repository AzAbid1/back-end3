<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518180940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apprenant (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, is_completed TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, enseignant_id INT NOT NULL, duree VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FDCA8C9CE455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_apprenant (cours_id INT NOT NULL, apprenant_id INT NOT NULL, INDEX IDX_3C4E7CE97ECF78B0 (cours_id), INDEX IDX_3C4E7CE9C5697D6D (apprenant_id), PRIMARY KEY(cours_id, apprenant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant (id INT NOT NULL, bio LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum (id INT AUTO_INCREMENT NOT NULL, cours_id INT NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_852BBECD7ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecon (id INT AUTO_INCREMENT NOT NULL, chapitre_id INT NOT NULL, titre VARCHAR(255) NOT NULL, content_path VARCHAR(255) NOT NULL, INDEX IDX_94E6242E1FBEEF7B (chapitre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, forum_id INT NOT NULL, utilisateur_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_B6BD307F29CCBAD0 (forum_id), INDEX IDX_B6BD307FFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, test_id INT NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_B6F7494E1E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, contenu LONGTEXT NOT NULL, is_right TINYINT(1) NOT NULL, INDEX IDX_5FB6DEC71E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, chapitre_id INT NOT NULL, description LONGTEXT DEFAULT NULL, note INT DEFAULT NULL, is_passed TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_D87F7E0C1FBEEF7B (chapitre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, mail_address VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462EBF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE cours_apprenant ADD CONSTRAINT FK_3C4E7CE97ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_apprenant ADD CONSTRAINT FK_3C4E7CE9C5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum ADD CONSTRAINT FK_852BBECD7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_94E6242E1FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F29CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C1FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_apprenant DROP FOREIGN KEY FK_3C4E7CE9C5697D6D');
        $this->addSql('ALTER TABLE lecon DROP FOREIGN KEY FK_94E6242E1FBEEF7B');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C1FBEEF7B');
        $this->addSql('ALTER TABLE cours_apprenant DROP FOREIGN KEY FK_3C4E7CE97ECF78B0');
        $this->addSql('ALTER TABLE forum DROP FOREIGN KEY FK_852BBECD7ECF78B0');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CE455FCC0');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F29CCBAD0');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E1E5D0459');
        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462EBF396750');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1BF396750');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FFB88E14F');
        $this->addSql('DROP TABLE apprenant');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cours_apprenant');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE forum');
        $this->addSql('DROP TABLE lecon');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateur');
    }
}
