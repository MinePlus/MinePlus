<?php

namespace MinePlus\WebSocketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WebSocketCommand extends ContainerAwareCommand {
    
    /*
     * Configure the command
     * 
     * @todo choose a better name for the command
     */
    public function configure()
    {
        $this->setName('websocket:start')
             ->setDescription('Long-running process to open WebSockets');
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting Server ...');
        // Start server here
    }
    
}

?>
