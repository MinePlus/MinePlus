<?php

namespace MinePlus\TimelineBundle\Renderer;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use MinePlus\TimelineBundle\TimelineInterface;

abstract class TemplateRenderer implements RendererInterface
{
    
    protected $engine;
    
    protected function getTemplate();
    
    public function setTemplateEngine(EngineInterace $engine)
    {
        $this->engine = $engine;
    }
    
    public function render(TimelineInterface $timeline){
        // check whether there is an engine given
        if (!$this->engine instanceof EngineInterface)
            throw new \Exception('No template engine given.');
        
        if (!$this->engine->exists($this->getTemplate()))
            throw new \Exception('The template <i>'.$this->getTemplate().'</i> does not exist.');
        
        return $this->engine->render($this->getTemplate(), array(
            'timeline' => $timeline
        ));
    }
    
}

?>