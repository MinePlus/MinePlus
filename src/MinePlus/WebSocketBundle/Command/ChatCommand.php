<?php

namespace MinePlus\WebSocketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChatCommand extends ContainerAwareCommand {
    
    /*
     * Configure the command
     */
    public function configure()
    {
        $this->setName('chat:start')
             ->setDescription('Long-running process that manages the chat');
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting Chat ...');
        // Start server here
    }
    
}

?>
