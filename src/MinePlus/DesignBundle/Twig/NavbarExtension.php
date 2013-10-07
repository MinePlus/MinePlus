<?php

namespace MinePlus\DesignBundle\Twig;

use Symfony\Component\EventDispatcher\EventDispatcher;
use MinePlus\DesignBundle\Event\Navbar\NavbarBuildEvent;
use MinePlus\DesignBundle\Navbar\Navbar;
use MinePlus\MainBundle\Event\Events;

class NavbarExtension extends \Twig_Extension
{
    
    protected $dispatcher;
    
    public function setDispatcher(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    
    /*
     * Get name of the extension
     * 
     * @return string
     */
    public function getName()
    {
        return 'navbar_extension';
    }
    
    /*
     * Get functions
     * 
     * @codeCoverageIgnore
     * 
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('navbar', array($this, 'getNavbar'))
        );
    }
    
    /*
     * Returns the collected navbar items from all listeners
     * 
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getNavbar($category)
    {
        $navbar = new Navbar(array(), Navbar::COLOR_UNDEFINED, $category);
        $event = $this->dispatcher->dispatch(Events::NAVBAR_BUILD, new NavbarBuildEvent($navbar));
        return $event->getNavbar();
    }
    
}

?>
