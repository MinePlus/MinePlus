<?php

namespace MinePlus\MainBundle\Event\Navbar;

use Symfony\Component\EventDispatcher\Event;
use Doctrine\Common\Collections\ArrayCollection;

class NavbarBuildEvent extends Event
{
    
    /*
     * Collection of items the navbar items should contain
     * 
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    protected $itemCollection;
    
    public function __construct()
    {
        $this->itemCollection = new ArrayCollection();
    }
    
    public function getItemCollection()
    {
        return $this->itemCollection;
    }
    
}

?>
