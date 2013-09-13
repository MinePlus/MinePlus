<?php

namespace MinePlus\MainBundle\Event\Config;

use Doctrine\Common\Collections\ArrayCollection;

class ConfigEditorBuildEvent extends ConfigEvent
{
    
    /*
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    protected $items;
    
    
    protected $category;
    
    /*
     * @param string $category
     */
    public function __construct($category = '')
    {
        $this->items = new ArrayCollection();
        $this->category = $category;
    }
    
    /*
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }
    
    public function getCategory()
    {
        return $this->category;
    }
    
}

?>
