<?php

namespace MinePlus\MainBundle\EventListener;

use MinePlus\MainBundle\Event\Navbar\NavbarBuildEvent;
use MinePlus\MainBundle\Navbar\Item;

class NavbarListener
{
    
    public function onNavbarBuild(NavbarBuildEvent $event)
    {
        $item = new Item('dashboard', 'dashboard');
        $event->getItemCollection()->add($item);
        
        $item = new Item('players', 'mineplus_main_player_list');
        $event->getItemCollection()->add($item); 
    }
    
}

?>
