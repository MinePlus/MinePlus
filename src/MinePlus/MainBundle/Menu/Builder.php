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
        // We don't need to check whether there's a logged-in user, because the template already does.
        $menu = $factory->createItem('root', array(
            'navbar' => true,
            'pull-right' => true
        ));
        
        $username = $this->container->get('security.context')->getToken()->getUsername();
        $context = $menu->addChild($username, array(
            'dropdown' => true,
            'caret' => true
        ));
        
        $context->addChild('logout', array(
            'icon' => 'log-out'
        ))->setUri('logout');

        return $this->dispatchEvent(new MenuBuildEvent($factory, $menu), Events::USER_CONTEXT_BUILD);
    }
    
    protected function dispatchEvent(MenuBuildEvent $event, $name) {
        $event = $this->container->get('event_dispatcher')->dispatch($name, $event);
        $menu = $event->getMenu();
        
        return $menu;
    }

}

?>
