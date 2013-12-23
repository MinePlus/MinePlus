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
        $menu = $factory->createItem('root', array(
            'navbar' => true
        ));
        
        $menu->addChild('dashboard', array('route' => 'dashboard'));
        $menu->addChild('players', array('route' => 'mineplus_main_player_list'));

        return $this->dispatchEvent(new MenuBuildEvent($factory, $menu), Events::MENU_BUILD);
    }
    
    public function userContext(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('MinePlus');
        
        $menu->addChild('logout')->setUri('logout')->setExtra('icon', 'log-out');
        
        // if user is an admin
        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $menu
                ->addChild('admin.area', array('route' => 'sonata_admin_redirect'))
                ->setExtra('icon', 'briefcase');
        }

        return $this->dispatchEvent(new MenuBuildEvent($factory, $menu), Events::USER_CONTEXT_BUILD);
    }
    
    protected function dispatchEvent(MenuBuildEvent $event, $name) {
        $event = $this->container->get('event_dispatcher')->dispatch($name, $event);
        $menu = $event->getMenu();
        
        return $menu;
    }

}

?>
