<?php

namespace MinePlus\WebSocketBundle;

use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    
    protected $clients;
    
    protected $output;
    
    public function __construct(OutputInterface $output)
    {
        $this->clients = new \SplObjectStorage;
        $this->output = $output;
    }
    
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->output->writeln('New Connection: '.$conn->resourceId);
    }
    
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->output->writeln($from->resourceId.': '.$msg);
    }
    
    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        $this->output->writeln('Lost Connection: '.$conn->resourceId);
    }
    
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }
    
}

?>
