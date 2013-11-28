<?php

namespace MinePlus\TimelineBundle\Renderer;

use MinePlus\TimelineBundle\Exception\TimelineRendererException;

class RendererManager
{
    
    protected $renderers = array();
    
    public function add($name, RendererInterface $renderer)
    {
        $renderers[$name] = $renderer;
    }
    
    public function get($name)
    {
        if (!in_array($name, $this->renderers))
            throw new TimelineRendererException('There is no <i>'.$name.'</i> renderer.');
        
        return $this->renderers[$name];
    }
    
}

?>