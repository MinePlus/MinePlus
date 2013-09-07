<?php

namespace MinePlus\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('MinePlusMainBundle:Admin:index.html.twig');
    }

    public function designAction()
    {
        return $this->render('MinePlusMainBundle:Admin:design.html.twig');
    }
    
}
