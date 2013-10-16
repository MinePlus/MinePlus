<?php

namespace MinePlus\VoterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use MinePlus\VoterBundle\DependencyInjection\Compiler\AddVoterPass;

class MinePlusVoterBundle extends Bundle
{
    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $container->addCompilerPass(new AddVoterPass());
    }
    
}
