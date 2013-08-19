<?php

namespace MinePlus\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    public function listAction()
    {
        $users = $this->get('fos_user.user_manager')->findUsers();
        
        return $this->render('MinePlusMainBundle:Player:list.html.twig', array(
            'users' => $users
        ));
    }
    
    public function showAction($username)
    {
        $user = $this->get('fos_user.user_manager')->findUserByUsername($username);
        
        return $this->render('MinePlusMainBundle:Player:show.html.twig', array(
            'user' => $user
        ));
    }

}
