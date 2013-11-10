<?php

namespace MinePlus\MainBundle\Event;

class Events
{
    
    /*
     * Called when the builder renders a menu.
     * 
     * The event listener receives an 
     * MinePlus\MainBundle\Event\Menu\MenuBuildEvent instance.
     * 
     * @var string
     */
    const MENU_BUILD = 'menu.build';
    
    /*
     * Called when the builder renders the user context.
     * 
     * The event listener receives an 
     * MinePlus\MainBundle\Event\Menu\MenuBuildEvent instance.
     * 
     * @var string
     */
    const USER_CONTEXT_BUILD = 'user_context.build';
    
    /*
     * Called BEFORE a post is published to a wall.
     * 
     * The event listener receives an
     * MinePlus\MainBundle\Event\Wall\WallPostEvent instance.
     * 
     * @var string
     */
    const WALL_POST = 'wall.post';
    
}

?>
