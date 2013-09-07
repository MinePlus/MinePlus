<?php

namespace MinePlus\MainBundle\Navbar;

class Item
{
 
    /*
     * The route to link to
     * 
     *  @var string
     */
    protected $route;
    
    /*
     * The translation key for the label
     * 
     * @var string
     */
    protected $label;
    
    public function __construct($route = null, $label = null) {
        $this->setRoute($route);
        $this->setLabel($label);
    }
    
    public function getRoute()
    {
        return $this->route;
    }
    
    public function setRoute($route)
    {
        $this->route = $route;
    }
    
    public function getLabel()
    {
        return $this->label;
    }
    
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
}

?>
