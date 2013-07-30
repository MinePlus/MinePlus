<?php

namespace Application\Migrations;

use MinePlus\MainBundle\Config\ConfigMigration;
use MinePlus\MainBundle\Config\Config;

class Version20130730163010 extends ConfigMigration
{
    
    public function configUp(Config $config)
    {
        $config->setOptions(array(
            'navbar' => array(
                'avatar' => array(
                    'show' => true,
                    'size' => 20
                )
            )
        ));
    }
    
    public function getConfigFile()
    {
        return 'design.yml';
    }
    
}
