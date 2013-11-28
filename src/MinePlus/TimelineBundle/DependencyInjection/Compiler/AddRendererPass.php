<?php

namespace MinePlus\TimelineBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AddRendererPass implements CompilerPassInterface
{
    
    const RENDERER_TAG = 'mineplus.timeline_renderer';
    
    public function process(ContainerBuilder $container)
    {
        $manager = $container->getDefinition('mineplus.renderer_manager');
        
        foreach ($container->findTaggedServiceIds(self::RENDERER_TAG) as $id => $attributes) {
            $arguments = array(
                'name' => $attributes['alias'],
                'renderer' => '@'.$id
            );
            
            $manager->addMethodCall('add', $arguments);
        }
    }
    
}

?>