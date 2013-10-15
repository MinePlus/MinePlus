<?php

namespace MinePlus\MainBundle\Event\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use MinePlus\MainBundle\Event\Event;

class MenuEvent extends Event
{
    
    protected $factory;
    
    protected $menu;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     * @param \Knp\Menu\ItemInterface $menu
     */
    public function __construct(FactoryInterface $factory, ItemInterface $menu)
    {
        $this->factory = $factory;
        $this->menu = $menu;
    }

    /**
     * @return \Knp\Menu\FactoryInterface
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @return \Knp\Menu\ItemInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }
    
}

?>
