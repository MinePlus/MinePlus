<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130831134534 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Wall (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_B3C740C8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Wall ADD CONSTRAINT FK_B3C740C8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE wall_post DROP INDEX UNIQ_9C2718ACA76ED395, ADD INDEX IDX_9C2718ACA76ED395 (user_id)");
        $this->addSql("ALTER TABLE wall_post ADD wall_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE wall_post ADD CONSTRAINT FK_9C2718ACC33923F1 FOREIGN KEY (wall_id) REFERENCES Wall (id)");
        $this->addSql("CREATE INDEX IDX_9C2718ACC33923F1 ON wall_post (wall_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE wall_post DROP FOREIGN KEY FK_9C2718ACC33923F1");
        $this->addSql("DROP TABLE Wall");
        $this->addSql("ALTER TABLE wall_post DROP INDEX IDX_9C2718ACA76ED395, ADD UNIQUE INDEX UNIQ_9C2718ACA76ED395 (user_id)");
        $this->addSql("DROP INDEX IDX_9C2718ACC33923F1 ON wall_post");
        $this->addSql("ALTER TABLE wall_post DROP wall_id");
    }
}
