<?php

namespace MinePlus\MainBundle\EventListener;

use MinePlus\DesignBundle\Event\Navbar\NavbarBuildEvent;
use MinePlus\DesignBundle\Navbar\Item;
use MinePlus\DesignBundle\Navbar\Navbar;
use Symfony\Component\Routing\Router;
use Symfony\Component\Translation\Translator;

class NavbarListener
{
    
    /*
     * @var \Symfony\Component\Routing\Router
     */
    protected $router;

    /*
     * @var \Symfony\Component\Translation\Translator
     */
    protected $translator;

    public function __construct(Router $router, Translator $translator)
    {
        $this->router = $router;
        $this->translator = $translator;
    }
    
    public function onNavbarBuild(NavbarBuildEvent $event)
    {
        $navbar = $event->getNavbar();
        if ($navbar->getCategory() == Navbar::CATEGORY_DEFAULT) {
            $items = array(
                new Item($this->translator->trans('dashboard'), $this->router->generate('dashboard')),
                new Item($this->translator->trans('players'), $this->router->generate('mineplus_main_player_list'))
            );
        } else if ($navbar->getCategory() == Navbar::CATEGORY_ADMIN) {
            $navbar->setColor(Navbar::COLOR_BLACK);
            $items = array(
                new Item($this->translator->trans('admin.area'), $this->router->generate('mineplus_main_admin_index')),
                new Item($this->translator->trans('admin.design'), $this->router->generate('mineplus_main_admin_design'))
            );
        } else $items = array();
        
        foreach ($items as $item) $navbar->getItems()->add($item);
    }
    
}

?>
