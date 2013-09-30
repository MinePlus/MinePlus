<?php

namespace MinePlus\DesignBundle\Navbar;

use Doctrine\Common\Collections\ArrayCollection;

class Navbar
{
    
    /*
     * @var string
     */
    const COLOR_WHITE = 'white';
    
    /*
     * @var string
     */
    const COLOR_BLACK = 'black';
    
    /*
     * When this is set, the color-choice is up to the template!
     * @var string
     */
    const COLOR_UNDEFINED = null;
    
    /*
     * @var string
     */
    const CATEGORY_ADMIN = 'admin';
    
    /*
     * @var string
     */
    const CATEGORY_DEFAULT = 'default';
    
    protected $items;
    
    protected $color;
    
    protected $category;
    
    /*
     * @param array $items
     */
    public function __construct($items = array(), $color = self::COLOR_UNDEFINED, $category = self::CATEGORY_DEFAULT) {
        $this->items = new ArrayCollection($items);
        $this->color = $color;
        $this->category = $category;
    }
    
    /*
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }
    
    /*
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
    
    /*
     * Set's the color for the navbar.
     * If the template doesn't know the specified color, it may be ignored.
     */
    public function setColor($color)
    {
        $this->color = $color;
        return this; // allow method chaining
    }
    
    /*
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
    
}

?>
