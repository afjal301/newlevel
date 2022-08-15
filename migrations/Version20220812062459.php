<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812062459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, time DATETIME NOT NULL, nbpeople INT NOT NULL, difficulty INT NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION DEFAULT NULL, is_favorite TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_engredient (recipe_id INT NOT NULL, engredient_id INT NOT NULL, INDEX IDX_38ED1E9D59D8A214 (recipe_id), INDEX IDX_38ED1E9D9855977 (engredient_id), PRIMARY KEY(recipe_id, engredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_engredient ADD CONSTRAINT FK_38ED1E9D59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_engredient ADD CONSTRAINT FK_38ED1E9D9855977 FOREIGN KEY (engredient_id) REFERENCES engredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe_engredient DROP FOREIGN KEY FK_38ED1E9D59D8A214');
        $this->addSql('ALTER TABLE recipe_engredient DROP FOREIGN KEY FK_38ED1E9D9855977');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_engredient');
    }
}
