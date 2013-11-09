<?php

namespace MinePlus\MainBundle\Menu\Renderer;

use Symfony\Component\Templating\EngineInterface;
use Knp\Menu\Renderer\RendererInterface;
use Knp\Menu\ItemInterface;
use MinePlus\MainBundle\Menu\CurrentMarker;

class MainRenderer implements RendererInterface
{
    
    protected $engine = null;
    
    protected $marker = null;
    
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
     */
    public function render(ItemInterface $item, array $options = array())
    {
        if (!$this->engine instanceof EngineInterface)
            throw new \Exception('No valid templating engine is given.');
            
        if ($this->marker != null)
            $item = $this->marker->mark($item);
        
        $options['menu'] = $item;
        
        return $this->engine->render('MinePlusMainBundle:Menu:bootstrap.html.twig', $options);
    }
    
}

?>
