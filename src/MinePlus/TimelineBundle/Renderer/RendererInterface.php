<?php

namespace MinePlus\TimelineBundle\Renderer;

use MinePlus\TimelineBundle\TimelineInterface;

interface RendererInterface
{
    
    public function render(TimelineInterface $timeline);
    
}

?>