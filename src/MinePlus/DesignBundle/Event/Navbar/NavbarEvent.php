<?php

namespace MinePlus\DesignBundle\Event\Navbar;

use MinePlus\MainBundle\Event\Event;
use MinePlus\DesignBundle\Navbar\Navbar;

class NavbarEvent extends Event
{
    
    /* 
     * @var MinePlus\DesignBundle\Navbar\Navbar
     */
    protected $navbar;
    
    /*
     * @param MinePlus\DesignBundle\Navbar\Navbar|null $navbar if null, a new one will be generated
     */
    public function __construct($navbar = null)
    {
        $this->navbar = ($navbar == null) ? new Navbar() : $navbar;
    }
    
    /*
     * @return MinePlus\DesignBundle\Navbar\Navbar
     */
    public function getNavbar()
    {
        return $this->navbar;
    }
    
}

?>
