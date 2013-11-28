<?php

namespace MinePlus\TimelineBundle\Item;

interface ItemInterface
{
    
    public function getTimestamp();
    
    public function getWriter();
    
    public function render();
    
}

?>