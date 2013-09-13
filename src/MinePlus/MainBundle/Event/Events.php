<?php

namespace MinePlus\MainBundle\Event;

class Events
{
    
    /*
     * Called when a view tries to generate a navbar.
     * 
     * The event listener receives an 
     * MinePlus\MainBundle\Event\Navbar\NavbarBuildEvent instance.
     * 
     * @var string
     */
    const NAVBAR_BUILD = 'navbar.build';
    
    /*
     * Called BEFORE a post is published to a wall.
     * 
     * The event listener receives an
     * MinePlus\MainBundle\Event\Wall\WallPostEvent instance.
     * 
     * @var string
     */
    const WALL_POST = 'wall.post';
    
    /*
     * Called when a controller tries to build a config editor
     * 
     * The event listener receives an
     * MinePlus\MainBundle\Event\Config\ConfigEditorBuildEvent instance
     */
    const CONFIG_EDITOR_BUILD = 'config.build';
    
}

?>
