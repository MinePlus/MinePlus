<?php

namespace MinePlus\MainBundle\Twig;

use Symfony\Component\EventDispatcher\EventDispatcher;
use MinePlus\MainBundle\Event\Navbar\NavbarBuildEvent;
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
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('navbar_items', array($this, 'getNavbarItems'))
        );
    }
    
    /*
     * Returns the collected navbar items from all listeners
     * 
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getNavbarItems()
    {
        $event = $this->dispatcher->dispatch(Events::NAVBAR_BUILD, new NavbarBuildEvent());
        return $event->getItemCollection();
    }
    
}

?>
