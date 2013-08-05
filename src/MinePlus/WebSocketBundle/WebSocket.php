<?php

namespace MinePlus\WebSocketBundle;

use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocket implements MessageComponentInterface {
    
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
        $this->broadcast($msg);
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
    
    private function broadcast($msg, $exception = null)
    {
        foreach ($this->clients as $client)
        {
            if ($exception != $client) $client->send($msg);
        }
    }
    
    private function send($client, $msg)
    {
        if (is_object($client)) {
            $client->send($msg);
        } else if (is_int($client)) {
            foreach ($this->clients as $c) {
                if ($c->resourceId == $client) {
                    $c->send($msg);
                }
            }
        }
    }
    
}

?>
