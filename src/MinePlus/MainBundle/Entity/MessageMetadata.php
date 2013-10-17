<?php

namespace MinePlus\MainBundle\Entity;

use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;
use FOS\MessageBundle\Model\MessageInterface;
use FOS\MessageBundle\Model\ParticipantInterface;

class MessageMetadata extends BaseMessageMetadata
{
    protected $id;

    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * @var ParticipantInterface
     */
    protected $participant;
}