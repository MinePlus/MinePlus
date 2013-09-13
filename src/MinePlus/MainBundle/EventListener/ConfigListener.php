<?php

namespace MinePlus\MainBundle\EventListener;

use Doctrine\ORM\EntityManager;
use MinePlus\MainBundle\Event\Config\ConfigEditorBuildEvent;

class ConfigListener
{
    
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function onConfigEditorBuild(ConfigEditorBuildEvent $event)
    {
        $em = $this->em;
        $result = $em->getRepository('MinePlusMainBundle:Config')->findAll();
     
        foreach ($result as $item) {
            if (stripos($item->getName(), $event->getCategory()) === 0) {
                $event->getItems()->add($item);
            }
        }
        
    }
    
}

?>
