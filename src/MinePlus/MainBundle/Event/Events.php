<?php

namespace MinePlus\MainBundle\Event;

class Events
{
    
    /*
     * Called when a view tries to generate a navbar.
     * 
     * The event listener receives an MinePlus\MainBundle\Event\NavbarEvent
     * instance.
     * 
     * @var string
     */
    const NAVBAR_BUILD = 'navbar.build';
    
}

?>
