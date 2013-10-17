<?php

namespace MinePlus\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\MessageBundle\Entity\Message as BaseMessage;

class Message extends BaseMessage
{
    protected $id;

    /**
     * @var ThreadInterface
     */
    protected $thread;

    /**
     * @var ParticipantInterface
     */
    protected $sender;

    /**
     * @var MessageMetadata
     */
    protected $metadata;
}