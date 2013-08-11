<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * We need this because there might be an error when migrating from the old session
 * table to the new one, which I can't solve by myself at this point.
 */
class Version20130811171722 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE `session`;");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE `session` ( `session_id` varchar(255) NOT NULL, `session_value` text NOT NULL, `session_time` int(11) NOT NULL, PRIMARY KEY (`session_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    }
}
