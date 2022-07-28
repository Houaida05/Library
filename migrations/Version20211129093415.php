<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211129093415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE emprunt ADD livres_id INT NOT NULL');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D767B3B43D FOREIGN KEY (users_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7EBF07F38 FOREIGN KEY (livres_id) REFERENCES livre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_364071D767B3B43D ON emprunt (users_id)');
        $this->addSql('CREATE INDEX IDX_364071D7EBF07F38 ON emprunt (livres_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE emprunt DROP CONSTRAINT FK_364071D767B3B43D');
        $this->addSql('ALTER TABLE emprunt DROP CONSTRAINT FK_364071D7EBF07F38');
        $this->addSql('DROP INDEX IDX_364071D767B3B43D');
        $this->addSql('DROP INDEX IDX_364071D7EBF07F38');
        $this->addSql('ALTER TABLE emprunt DROP users_id');
        $this->addSql('ALTER TABLE emprunt DROP livres_id');
    }
}
