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
        // Get the config file
        $kernel = $this->getContainer()->get('kernel');
        $config = new Config($kernel->getRootDir().'/config/'.$this->getConfigFile());
        
        // Run migration
        $this->configUp($config);
        
        // Save changes
        $config->save();
    }
    
    public function configUp(Config $config)
    {
    }
    
    public function getConfigFile()
    {
        return 'config.yml';
    }
    
}

?>
