<?php

namespace MinePlus\WebSocketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use MinePlus\WebSocketBundle\WebSocket;

class WebSocketCommand extends ContainerAwareCommand {
    
    /*
     * Configure the command
     */
    public function configure()
    {
        $this->setName('wsserver:start')
             ->setDescription('Long-running process that manages the websockets');
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting Server ...');
        
        // Start server
        $server = IoServer::factory(new WsServer(new WebSocket($output)), 8081);
        $server->run();
    }
    
}

?>
