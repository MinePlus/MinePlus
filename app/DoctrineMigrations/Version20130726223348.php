<?php

namespace Application\Migrations;

use MinePlus\MainBundle\Config\ConfigMigration;
use MinePlus\MainBundle\Config\Config;

class Version20130726223348 extends ConfigMigration
{

    public function configUp(Config $config) {
        $config->setOptions(array(
            'navbar' => array(
                'inverse' => true,
                'rounded_borders' => false
            ),
            'color' => array(
                1 => '#EDEFF1',
                2 => '#1ABC9C'
            )
        ));
    }
    
    public function getConfigFile() {
        return 'design.yml';
    }
}
