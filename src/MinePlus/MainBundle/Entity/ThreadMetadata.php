<?php

namespace MinePlus\MainBundle\Entity;

use FOS\MessageBundle\Entity\ThreadMetadata as BaseThreadMetadata;

class ThreadMetadata extends BaseThreadMetadata
{
    protected $id;

    /**
     * @var ThreadInterface
     */
    protected $thread;

    /**
     * @var ParticipantInterface
     */
    protected $participant;
}