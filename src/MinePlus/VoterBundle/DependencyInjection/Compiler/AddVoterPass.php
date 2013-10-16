<?php

namespace MinePlus\VoterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AddVoterPass implements CompilerPassInterface
{
    
    const VOTER_TAG = 'mineplus.voter';
    
    const DEFAULT_MULTIPLICATOR = 10;
    
    public function process(ContainerBuilder $container)
    {
        $dispatcher = $container->get('vote_dispatcher');
        
        foreach ($container->findTaggedServiceIds(self::VOTER_TAG) as $id => $attributes ) {
            $multiplicator = (array_key_exists('multiplicator', $attributes)) ? $attributes['multiplicator'] : self::DEFAULT_MULTIPLICATOR;
            
            $callable = array($container->get($id), $attributes['method']);
            
            $dispatcher->addVoter($attributes['event'], $callable, $multiplicator);
        }
    }
    
}

?>
