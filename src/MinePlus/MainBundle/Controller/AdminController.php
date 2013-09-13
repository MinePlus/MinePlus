<?php

namespace MinePlus\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MinePlus\MainBundle\Event\Events;
use MinePlus\MainBundle\Event\Config\ConfigEditorBuildEvent;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('MinePlusMainBundle:Admin:index.html.twig');
    }

    public function designAction()
    {
        $dispatcher = $this->get('event_dispatcher');
        
        $event = new ConfigEditorBuildEvent('design');
        $event = $dispatcher->dispatch(Events::CONFIG_EDITOR_BUILD, $event);
        
        return $this->render('MinePlusMainBundle:Admin:design.html.twig', array(
            'config' => $event->getItems()
        ));
    }
    
}
