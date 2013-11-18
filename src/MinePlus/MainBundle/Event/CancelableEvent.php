<?php

namespace MinePlus\MainBundle\Event;

class CancelableEvent extends \Symfony\Component\EventDispatcher\Event
{
    
    /*
     * Marks the event as canceled, the event action (e.g. create a new user)
     * will not be executed.
     * This will also stop the event propatation.
     * 
     * @var boolean
     */
    protected $canceled = false;
    
    public function cancel()
    {
        $this->canceled = true;
        
        $this->stopPropagation();
    }
    
    public function isCanceled()
    {
        return $this->canceled;
    }
    
}

?>
