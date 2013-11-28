<?php

namespace MinePlus\TimelineBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use MinePlus\TimelineBundle\DependencyInjection\Compiler\AddRendererPass;

class MinePlusTimelineBundle extends Bundle
{
    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $container->addCompilerPass(new AddRendererPass());
    }
    
}
