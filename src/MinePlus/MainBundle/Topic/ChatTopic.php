<?php

namespace MinePlus\MainBundle\Topic;

use JDare\ClankBundle\Topic\TopicInterface;
use Ratchet\ConnectionInterface;

class ChatTopic implements TopicInterface
{
    
    /**
     * This will receive any Publish requests for this topic.
     *
     * @param \Ratchet\ConnectionInterface $conn
     * @param $topic
     * @param $event
     * @param array $exclude
     * @param array $eligible
     * @return mixed|void
     */
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        if ($topic->getId() == 'chat/channel/public') {
            if (strlen($event['msg']) > 0) { // Prevent empty messages
                $msg = $this->getUser($conn)->getUsername().': '.$event['msg'];
                
                $topic->broadcast(array(
                    'sender' => $this->getUser($conn)->getUsername(),
                    'topic' => $topic->getId(),
                    'msg' => $msg
                ));
            } else {
                $conn->send(array(
                    'msg' => '<i style="text-color: red;">You can\'t send empty messages!</i>'
                ));
            }
        }
    }

    /**
     * This will receive any Subscription requests for this topic.
     *
     * @param \Ratchet\ConnectionInterface $conn
     * @param $topic
     * @return void
     */
    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->sendSystemBroadcast($topic, $this->getUser($conn)->getUsername().' joined the chat.');
    }

    /**
     * This will receive any UnSubscription requests for this topic.
     *
     * @param \Ratchet\ConnectionInterface $conn
     * @param $topic
     * @return void
     */
    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->sendSystemBroadcast($topic, $this->getUser($conn)->getUsername().' left the chat.');
    }
    
    /*
     * Extracts the user from a connection
     * 
     * @param \Ratchet\ConnectionInterface $conn Connection
     * 
     * @return \MinePlus\MainBundle\Entity\User User
     */
    public function getUser(ConnectionInterface $conn)
    {
        // This attribute is only for debugging, isn't it? :/
        $token = $conn->Session->get('_security_main');
        $token = unserialize($token);
        return $token->getUser();
    }
    
    /*
     * Broadasts a message as System
     * 
     * @param mixed $topic topic to broadccast the message to.
     * @param string $msg message to send
     */
    public function sendSystemBroadcast($topic, $msg)
    {
        $topic->broadcast(array(
            'msg' => '<b>System: '.$msg.'</b>'
        ));
    }
}

?>