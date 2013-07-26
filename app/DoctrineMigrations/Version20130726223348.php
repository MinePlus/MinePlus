<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130726223348 extends AbstractMigration implements ContainerAwareInterface
{
    
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function up(Schema $schema)
    {
    }
    
    public function down(Schema $schema)
    {
    }

    public function postUp(Schema $schema) {
        $config = $this->container->get('design_configuration');
        $config->addOptions(array(
            'navbar' => array(
                'inverse' => true,
                'rounded_borders' => false
            )
        ));
    }
}
