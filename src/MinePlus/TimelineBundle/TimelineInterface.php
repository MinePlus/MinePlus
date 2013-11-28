<?php

namespace MinePlus\TimelineBundle;

interface TimelineInterface
{
    
    public function addItem($item);
    
    public function getItems($limit, $offset);
    
}

?>