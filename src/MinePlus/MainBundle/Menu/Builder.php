<?php

namespace MinePlus\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('MinePlus');
        
        $menu->addChild('dashboard', array('route' => 'dashboard'));
        $menu->addChild('players', array('route' => 'mineplus_main_player_list'));
        
        return $menu;
    }

}

?>
