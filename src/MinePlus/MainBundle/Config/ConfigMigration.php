<?php

namespace MinePlus\MainBundle\Config;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/*
 * @todo documentation
 */
class ConfigMigration extends AbstractMigration implements ContainerAwareInterface
{
    
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function getContainer()
    {
        return $this->container;
    }
    
    // Just because we need to implement them
    public function up(Schema $schema) {}
    public function down(Schema $schema) {}
    
    public function postUp(Schema $schema)
    {
        $array = $this->configUp();
        $kernel = $this->getContainer()->get('kernel');
        $config = new Config($kernel->getRootDir().'/config/'.$this->getConfigFile());
        $config->setOptions($array);
        $config->save();
    }
    
    public function configUp()
    {
        return array();
    }
    
    public function getConfigFile()
    {
        return 'config.yml';
    }
    
}

?>
