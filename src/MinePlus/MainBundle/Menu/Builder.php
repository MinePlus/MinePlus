<?php

namespace MinePlus\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use MinePlus\MainBundle\Event\Events;
use MinePlus\MainBundle\Event\Menu\MenuBuildEvent;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('MinePlus');
        
        $menu->addChild('dashboard', array('route' => 'dashboard'));
        $menu->addChild('players', array('route' => 'mineplus_main_player_list'));
        
        $event = $this->container->get('event_dispatcher')->dispatch(Events::MENU_BUILD, new MenuBuildEvent($factory, $menu));
        $menu = $event->getMenu();
        
        return $menu;
    }

}

?>
