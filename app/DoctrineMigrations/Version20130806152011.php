<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130806152011 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE users ADD username_canonical VARCHAR(255) NOT NULL, ADD email_canonical VARCHAR(255) NOT NULL, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) NOT NULL, ADD last_login DATETIME DEFAULT NULL, ADD locked TINYINT(1) NOT NULL, ADD expired TINYINT(1) NOT NULL, ADD expires_at DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(255) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', ADD credentials_expired TINYINT(1) NOT NULL, ADD credentials_expire_at DATETIME DEFAULT NULL, DROP admin, DROP owner, DROP online, CHANGE username username VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_1483A5E992FC23A8 ON users (username_canonical)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_1483A5E9A0D96FBF ON users (email_canonical)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP INDEX UNIQ_1483A5E992FC23A8 ON users");
        $this->addSql("DROP INDEX UNIQ_1483A5E9A0D96FBF ON users");
        $this->addSql("ALTER TABLE users ADD admin TINYINT(1) NOT NULL, ADD owner TINYINT(1) NOT NULL, ADD online TINYINT(1) NOT NULL, DROP username_canonical, DROP email_canonical, DROP enabled, DROP salt, DROP last_login, DROP locked, DROP expired, DROP expires_at, DROP confirmation_token, DROP password_requested_at, DROP roles, DROP credentials_expired, DROP credentials_expire_at, CHANGE username username VARCHAR(16) NOT NULL, CHANGE password password VARCHAR(40) NOT NULL");
    }
}
