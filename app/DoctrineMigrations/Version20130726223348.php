<?php

namespace Application\Migrations;

use MinePlus\MainBundle\Config\ConfigMigration;

class Version20130726223348 extends ConfigMigration
{

    public function configUp() {
        return array(
            'navbar' => array(
                'inverse' => true,
                'rounded_borders' => false
            ),
            'color' => array(
                1 => '#EDEFF1',
                2 => '#1ABC9C'
            )
        );
    }
    
    public function getConfigFile() {
        return 'design.yml';
    }
}
