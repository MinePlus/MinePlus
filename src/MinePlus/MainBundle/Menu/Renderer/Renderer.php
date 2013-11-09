<?php

namespace MinePlus\MainBundle\Menu\Renderer;

use Symfony\Component\Templating\EngineInterface;
use Knp\Menu\Renderer\RendererInterface;
use Knp\Menu\ItemInterface;
use MinePlus\MainBundle\Menu\CurrentMarker;

abstract class Renderer implements RendererInterface
{
    
    protected $engine = null;
    
    protected $marker = null;
    
    /*
     * Returns template name, e.g. 'MinePlusMainBundle:Menu:main.html.twig'
     * 
     * @return string
     */
    abstract protected function getTemplateName();
    
    public function setTemplatingEngine(EngineInterface $engine)
    {
        $this->engine = $engine;
    }
    
    public function setCurrentMarker(CurrentMarker $marker)
    {
        $this->marker = $marker;
    }
    
    /*
     * @throws \Exception if no templating engine is given.
     * 
     * @param \Knp\Menu\ItemInterface $item Menu item
     * @param array $options some rendering options
     * @return string
     */
    public function render(ItemInterface $item, array $options = array())
    {
        if (!$this->engine instanceof EngineInterface)
            throw new \Exception('No valid templating engine is given.');
            
        if ($this->marker != null)
            $item = $this->marker->mark($item);
        
        $options['menu'] = $item;
        $templateName = $this->getTemplateName();
        
        return $this->engine->render($templateName, $options);
    }
    
}
