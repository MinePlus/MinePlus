<?php

namespace MinePlus\TimelineBundle;

class Timeline implements TimelineInterface
{
    
    protected $items = array();
    
    public function addItem($item)
    {
        $items[] = $item;
    }
    
    public function getItems($limit, $offset)
    {
        return $this->items;
    }
    
}

?>