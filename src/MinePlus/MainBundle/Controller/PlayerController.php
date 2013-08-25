<?php

namespace MinePlus\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    public function listAction()
    {
        $users = $this->get('fos_user.user_manager')->findUsers();
        
        $usersToView = array();
        
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $me = $this->get('security.context')->getToken()->getUser();
            
            foreach ($users as $user) {
                if ($user->getUsername() != $me->getUsername()) 
                    $usersToView[] = $user;
            }
        } else {
            $usersToView = $users;
        }
        
        return $this->render('MinePlusMainBundle:Player:list.html.twig', array(
            'users' => $usersToView
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
