<?php

namespace MinePlus\MainBundle\Menu;

use Symfony\Component\Templating\EngineInterface;
use Knp\Menu\Renderer\RendererInterface;
use Knp\Menu\ItemInterface;

class BootstrapRenderer implements RendererInterface
{
    
    protected $engine;
    
    public function setTemplatingEngine(EngineInterface $engine)
    {
        $this->engine = $engine;
    }
    
    public function render(ItemInterface $item, array $options = array())
    {
        $options['menu'] = $item;
        
        return $this->engine->render('MinePlusMainBundle:Menu:bootstrap.html.twig', $options);
    }
    
}

?>
